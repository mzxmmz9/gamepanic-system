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
        return view('machine_downtimes.confirm');
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
    public function update(Request $request, $id)
    {
        // バリデーション
        $validated = $request->validate([
            'machine_code'    => ['required', 'string', 'max:50'],
            'downtime_start'  => ['required', 'date'],
            'downtime_end'    => ['nullable', 'date', 'after_or_equal:downtime_start'], 
            'reason'          => ['nullable', 'string', 'max:255'],
        ]);

        // 対象レコード取得
        $updateRecord = MachineDowntime::findOrFail($id);

        // 更新
        $updateRecord->update($validated);

        // リダイレクトやレスポンス
        return redirect()->route('posts.show', $post)->with('success', '更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
