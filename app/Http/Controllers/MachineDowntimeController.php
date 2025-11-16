<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MachineDowntime;

class MachineDowntimeController extends Controller
{
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
            'reason' => 'required|string'
            , 'downtime_start' => 'required|date'
        ]);

        return view('machine_downtimes.confirm', compact('validated'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        MachineDowntime::create($request->only([
            'reason'
            , 'downtime_start'
        ]));

        return redirect()->route('dashboard')->with('success', '登録しました');
    }

    /**
     * マシンの休止終了日時を記入するマシン を選択する一覧画面
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
