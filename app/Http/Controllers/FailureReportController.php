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

		// レポート取得（店別フィルタ対応）
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
	
	public function confirm()
	{

		$data = session('report_data');

		if (!$data) {
			return redirect()->route('failure_reports.submit')->with('error', '確認データがありません');
		}

		return view('failure_reports.confirm', compact('data'));
	}

	public function confirmUpdate()
	{

		$data = session('report_data');

		if (!$data) {
			return redirect()->route('failure_reports.submit')->with('error', '確認データがありません');
		}

		return view('failure_reports.confirm-update', compact('data'));
	}


	public function store(Request $request)
	{
		$data = session('report_data');

		// null チェック
		if (!$data) {
			return redirect()->route('failure_reports.create')->withErrors('報告データ登録エラー。もう一度、登録処理を行ってください。');
		}

		// モデルに保存
		FailureReport::create($data);

		// セッションをクリア
		session()->forget('report_data');

		return redirect()->route('dashboard')->with('success', '報告を登録しました');
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
		// セッションから確認用データを取り出す
		$data = session('report_data');

		if (!$data) {
			// セッションが空なら一覧に戻す
			return redirect()->route('failure_reports.index')
							 ->with('error', '更新データが見つかりませんでした。');
		}

		// 既存レコードを更新する場合
		// 例: hiddenでidを送っているなら $request->input('id') を使う
		if (isset($data['id'])) {
			$report = FailureReport::findOrFail($data['id']);
			$report->update($data);
		} else {
			// 新規作成の場合
			FailureReport::create($data);
		}

		// セッションをクリア
		session()->forget('report_data');

		return redirect()->route('failure_reports.index')
						 ->with('success', '故障報告を保存しました。');
	}


	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
