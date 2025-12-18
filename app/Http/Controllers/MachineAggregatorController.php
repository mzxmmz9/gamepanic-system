<?php

namespace App\Http\Controllers;

use App\Models\ViewMachineAggregator;
use App\Models\Branch;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MachineAggregatorController extends Controller
{

	public function index(Request $request)
	{
		$branchId = $request->input('branch_id'); // プルダウンで選択された店舗ID

		$query = ViewMachineAggregator::query();

		if ($branchId) {
			$query->where('branch_id', $branchId);
		}

		$machines = $query->paginate(50);

		// 店舗一覧を取得（プルダウン用）
		$branches = Branch::all();

		// 休止時間・損失額の計算
		foreach ($machines as $machine) {
			$start = Carbon::parse($machine->downtime_start);
			$end   = $machine->downtime_end
						? Carbon::parse($machine->downtime_end)
						: Carbon::now();

			// 営業時間内のみの休止時間計算
			$businessMinutes = 0;
			$cursor = $start->copy();
			while ($cursor < $end) {
				$dayOpen  = $cursor->copy()->setTime(10, 0, 0);
				$dayClose = $cursor->copy()->setTime(24, 0, 0);
				$rangeStart = $cursor->greaterThan($dayOpen) ? $cursor : $dayOpen;
				$rangeEnd   = $end->lessThan($dayClose) ? $end : $dayClose;
				if ($rangeStart < $rangeEnd) {
					$businessMinutes += $rangeStart->diffInMinutes($rangeEnd);
				}
				$cursor = $dayClose;
			}

			// 画面表示用の休止時間文字列(〇時間〇分)
			$hours  = intdiv($businessMinutes, 60);
			$remain = $businessMinutes % 60;
			$machine->downtime_diff = "{$hours}時間{$remain}分";
			// 損失額計算(いったん1時間×1000円)
			$lossHours = $businessMinutes / 60.0;
			$machine->loss_amount = (int) round($lossHours * 1000);
		}

		return view('machine_aggregators.index', compact('machines', 'branches', 'branchId'));
	}

}