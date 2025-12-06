<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
		$downtimeMachines = MachineDowntime::orderBy('downtime_start')->get();
		return view('machine_downtimes.index', compact('downtimeMachines'));
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
		return view('machine_downtimes.edit');
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
