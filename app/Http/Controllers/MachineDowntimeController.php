<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MachineDowntimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
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
        //
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
