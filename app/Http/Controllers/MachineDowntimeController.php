<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MachineDowntime;
use App\Models\MachineStatus;
use App\Models\Branch;
use Carbon\Carbon;

class MachineDowntimeController extends Controller
{
	public string $machine_code = '';
	protected $listeners = ['machineCodeSelected' => 'setMachineCode'];
	
	public function setMachineCode($code)
	{
		$this->machine_code = $code;
	}

	/**
	 * マシン休止開始日時を記入する画面
	 */
	public function create()
	{
		return view('machine_downtimes.create');
	}

	/**
	 * マシン休止開始日時を入力した後の確認画面
	 */
	public function confirm(Request $request)
	{
		$validated = $request->validate([
			'machine_code'   => 'required|string',
			'downtime_start' => 'required|date',
			'downtime_end'   => 'nullable|date|after_or_equal:downtime_start',
			'reason'         => 'nullable|string|max:1000',
		]);
		session(['report_data' => $validated]);
		$data = session('report_data');
		
		if (!$data) {
			return redirect()->route('machine_downtimes.create')->with('error', '確認データがありません');
		}

		return view('machine_downtimes.confirm', compact('data'));
	}

	/**
	 * マシン休止開始日時登録後、休止一覧画面へ遷移
	 */
	public function store(Request $request)
	{
		$data = $request->only(['machine_code', 'downtime_start', 'downtime_end', 'reason']);

		MachineDowntime::create($data);

		return redirect()->route('machine_downtimes.index')->with('success', '登録完了しました');
	}

	/**
	 * マシン休止履歴一覧
	 */
	public function index(Request $request)
	{
		// 選択された店舗ID（未選択なら null）
		$selectedBranch = $request->branch_id;

		// 店一覧
		$branches = Branch::orderBy('name')->get();

		// データ取得
		$records = DB::table('machine_downtimes as downtime')
			->leftJoin('machine_branches as m_branch', 'downtime.machine_code', '=', 'm_branch.machine_code')
			->join('branches as branch', 'm_branch.branch_id', '=', 'branch.id')
			->leftJoin('machines as machine', 'downtime.machine_code', '=', 'machine.code')
			->select(
				'downtime.id',
				'branch.name as branch_name',
				'downtime.machine_code',
				'machine.name as machine_name',
				'downtime.downtime_start',
				'downtime.downtime_end',
				'downtime.reason'
			)
			->when($selectedBranch, function ($query) use ($selectedBranch) {
				return $query->where('branch.id', $selectedBranch);
			})
			->whereNull('downtime.downtime_end')
			->orderBy('branch.id')
			->orderBy('downtime.downtime_start', 'desc')
			->get();

		return view('machine_downtimes.index', compact(
			'records',
			'branches',
			'selectedBranch'
		));
	}

	/**
	 * マシン休止終了日を入力する画面
	 */
	public function edit($id)
	{
		// 指定 ID のレコードを取得（存在しなければ null）
		$report = DB::table('machine_downtimes as downtime')
			->leftJoin('machine_branches as m_branch', 'downtime.machine_code', '=', 'm_branch.machine_code')
			->join('branches as branch', 'm_branch.branch_id', '=', 'branch.id')
			->leftJoin('machines as machine', 'downtime.machine_code', '=', 'machine.code')
			->select(
				'downtime.id',
				'branch.name as branch_name',
				'downtime.machine_code',
				'machine.name as machine_name',
				'downtime.downtime_start',
				'downtime.downtime_end',
				'downtime.reason'
			)
			->where('downtime.id', $id)          // ← IDで抽出
			->first();                           // ← 単一レコード取得

		if (!$report) {
			abort(404); // レコードがなければ404
		}

		return view('machine_downtimes.edit', compact('report'));
	}

	/**
	 * マシン休止終了を入力した後の確認画面
	 */
	public function updateConfirm(Request $request, $id)
	{
		// バリデーション
		$validated = $request->validate([
			'downtime_end' => 'nullable|date|after_or_equal:downtime_start',
		]);

		// 元のレコードを取得
		$report = DB::table('machine_downtimes as downtime')
			->leftJoin('machine_branches as m_branch', 'downtime.machine_code', '=', 'm_branch.machine_code')
			->join('branches as branch', 'm_branch.branch_id', '=', 'branch.id')
			->leftJoin('machines as machine', 'downtime.machine_code', '=', 'machine.code')
			->select(
				'downtime.id',
				'branch.name as branch_name',
				'downtime.machine_code',
				'machine.name as machine_name',
				'downtime.downtime_start',
				'downtime.reason'
			)
			->where('downtime.id', $id)
			->first();

		// 入力値をマージして確認画面へ
		$report->downtime_end = $validated['downtime_end'] ?? null;

		return view('machine_downtimes.update_confirm', compact('report'));
	}

	/**
	 * マシン休止終了日時を登録（レコード更新）
	 */
	public function update(Request $request, $id)
	{
		$validated = $request->validate([
			'downtime_end' => 'nullable|date|after_or_equal:downtime_start',
		]);

		// 対象の休止レコードを取得
		$downtime = MachineDowntime::findOrFail($id);
		$downtime->downtime_end = $validated['downtime_end'];
		$downtime->save();

		// 紐づくステータスを更新
		// machine_code をキーにして Status テーブルを検索
		$status = MachineStatus::where('machine_code', $downtime->machine_code)->first();

		if ($status) {
			// 休止終了したので稼働中に戻す
			$status->status_id = 1; // (1:稼働)
			$status->updated_at = now(); // 更新日時を記録する場合
			$status->save();
		}

		return redirect()->route('machine_aggregators.index')
						->with('success', '休止終了日時とステータスを更新しました');
	}
}
