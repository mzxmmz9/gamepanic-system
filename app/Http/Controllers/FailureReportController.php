<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FailureReport;

class FailureReportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$reports = FailureReport::whereNull('resumed_at')->get();
		return view('failure_reports.index', compact('reports'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('failure_reports.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function confirm(Request $request)
	{
		$validated = $request->validate([
			'body' => 'required|string',
		]);

		return view('failure_reports.confirm', ['input' => $validated]);
	}

	public function store(Request $request)
	{
		FailureReport::create($request->all());
		return redirect()->route('dashboard')->with('success', '報告を登録しました');
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
	public function edit(string $id)
	{
		$report = FailureReport::findOrFail($id);
		return view('failure_reports.edit', compact('report'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
