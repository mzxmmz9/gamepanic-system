<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MachineDowntime;

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

	public function confirm(Request $request)
	{
		$validated = $request->validate([
			'machine_code'   => 'required|string',
			'downtime_start' => 'required|date',
			'downtime_end'   => 'nullable|after_or_equal:downtime_start',
			'reason'         => 'nullable|string|max:500',
		]);
		session(['report_data' => $validated]);
		$data = session('report_data');
		if (!$data) {
			return redirect()->route('machine_downtimes.create')->with('error', '確認データがありません');
		}

		return view('machine_downtimes.confirm', compact('data'));
	}

	public function store(Request $request)
	{
		$data = $request->only(['machine_code', 'downtime_start', 'downtime_end', 'reason']);
		MachineDowntime::create($data);

		return redirect()->route('machine_downtimes.index')->with('success', '登録完了しました');
	}

	/**
	 * 休止終了日時を記入するマシン を選択する一覧画面
	 */
	public function index()
	{
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
			->whereNull('downtime.downtime_end')
			->orderBy('branch.id')
			->orderBy('downtime.downtime_start', 'desc')
			->get();
		return view('machine_downtimes.index', compact('records'));
	}
	
	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
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
	 * Update the specified resource in storage.
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

	public function update(Request $request, $id)
	{
		$validated = $request->validate([
			'downtime_end' => 'nullable|date|after_or_equal:downtime_start',
		]);

		DB::table('machine_downtimes')
			->where('id', $id)
			->update([
				'downtime_end' => $validated['downtime_end'] ?? null,
				'updated_at'   => now(),
			]);

		return redirect()->route('machine_aggregators.index')
						 ->with('success', '休止終了日時を更新しました');
	}



	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
