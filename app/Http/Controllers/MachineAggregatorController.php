<?php

namespace App\Http\Controllers;

use App\Models\MachineAggregator;
use App\Models\Branch;

class MachineAggregatorController extends Controller
{
    public function index()
    {
        $aggregators = MachineAggregator::orderBy('store_name')->get();
        $branches = Branch::orderBy('name')->get();
        return view('machine_aggregators.index', compact('aggregators', 'branches'));
    }
}