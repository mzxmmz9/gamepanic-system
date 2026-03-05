<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FailureReport;
use App\Models\Branch;

class FailureReportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		// 店一覧
		$branches = Branch::orderBy('name')->get();

		// 選択された店舗ID（未選択なら null）
		$selectedBranch = $request->branch_id;

		// レポート取得
		$query = FailureReport::whereNull('resumed_at');

		if (!empty($selectedBranch)) {
			$query->where('branch_id', $selectedBranch);
		}

		$reports = $query->get();

		// 各 report に branch_name を付与
		$reports->map(function ($report) {
			$report->branch_name = Branch::find($report->branch_id)?->name;
			return $report;
		});

		return view('failure_reports.index', compact('reports', 'branches', 'selectedBranch'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('failure_reports.create');
	}
	
	/**
	 * Show the form for creating a new resource.
	 */
	public function formCreate(Request $request)
	{
	    $machine = $request->input('machine'); 
		return view('failure_reports.form-create', compact('machine'));
	}

	public function confirm(Request $request)
	{
		// POST された全データを取得
		$data = $request->all();

		return view('failure_reports.confirm', [
			'data' => $data,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function formUpdate(Request $request)
	{
		$report = json_decode($request->input('report'), true);

		return view('failure_reports.form-update', [
			'report' => $report,
		]);
	}

	public function confirmUpdate(Request $request)
	{
		// 入力画面から送られてきた値を全部取得
		$data = $request->all();

		// セッションに保存（confirm-update.blade がこれを読む）
		session(['report_data' => $data]);

		// Blade に渡す必要はない（session から読むため）
		return view('failure_reports.confirm-update');
	}

	public function store(Request $request)
	{
		// バリデーション
		$validated = $request->validate([
			'branch_id' => 'required|string',
			'occurred_at' => 'required|date',
			'occurred_by' => 'required|string',
			'process' => 'required|string',

			'machine_code' => 'required|string',
			'machine_name' => 'required|string',

			'st_num' => 'nullable|string',
			'malfunction' => 'nullable|string',
			'note' => 'nullable|string',

		]);

		// DB 保存
		FailureReport::create($validated);

		return redirect()->route('dashboard')
			->with('success', '報告を登録しました');
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$report = FailureReport::findOrFail($id);
		return view('failure_reports.edit', compact('report'));
	}

	/**
	 * Update the specified resource in storage.
	*/
	public function update(Request $request)
	{
		// confirm-update で保存したデータを取得
		$data = session('report_data');

		if (!$data) {
			return redirect()
				->route('failure_reports.index')
				->with('error', '更新データが見つかりませんでした。');
		}

		// 更新対象のレコードを取得
		$report = FailureReport::find($data['id']);

		if (!$report) {
			return redirect()
				->route('failure_reports.index')
				->with('error', '対象の報告書が見つかりませんでした。');
		}

		// 更新処理
		$report->update([
			'process'     => $data['process'],
			'resumed_at'  => $data['resumed_at'],
			'resumed_by'  => $data['resumed_by'],
			'note'        => $data['note'],
		]);

		// セッション削除
		session()->forget('report_data');

		return redirect()
			->route('failure_reports.index')
			->with('message', '報告書を更新しました。');
	}


	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
