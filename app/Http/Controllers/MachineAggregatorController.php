<?php

namespace App\Http\Controllers;

use App\Models\MachineAggregator;
use App\Models\Branch;
use App\Models\MachineDowntime;
use Illuminate\Http\Request;

class MachineAggregatorController extends Controller
{
    public function index(Request $request)
    {
        //全店取得
        $branches = Branch::all();

        //休止マシン一覧取得
        $machines = MachineDowntime::all();

        return view('machine_aggregators.index', compact('branches', 'machines'));
    }

}