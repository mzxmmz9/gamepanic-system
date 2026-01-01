<?php

namespace App\Http\Controllers;

use App\Models\ViewMachineAggregator;
use App\Models\Branch;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Exports\MachineAggregatorExport;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MachineAggregatorController extends Controller
{

	public function index(Request $request)
	{
		$branchId = $request->input('branch_id');// 抽出する店舗
		$from     = $request->input('from');	// 抽出開始日
		$to       = $request->input('to');		// 抽出終了日

		$query = ViewMachineAggregator::query();

		// 店舗プルダウン
		if ($branchId) {
			$query->where('branch_id', $branchId);
		}

		// 期間フィルター（downtime_start 基準）
		if ($from) {
			$query->where('downtime_start', '>=', $from . ' 00:00:00');
		}

		if ($to) {
			$query->where('downtime_start', '<=', $to . ' 23:59:59');
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

		return view('machine_aggregators.index', compact('machines', 'branches', 'branchId', 'from', 'to'));
	}

	// Excel出力
	public function export(Request $request)
	{
		$branchId = $request->input('branch_id');
		$from     = $request->input('from');
		$to       = $request->input('to');

		$query = DB::table('view_machine_aggregator');
		// 店舗フィルタ
		if ($branchId) {
			$query->where('branch_id', $branchId);
		}
		// フィルタ開始日
		if ($from) {
			$query->where('downtime_start', '>=', $from . ' 00:00:00');
		}
		// フィルタ終了日
		if ($to) {
			$query->where('downtime_start', '<=', $to . ' 23:59:59');
		}

		// SQL 実行
		$collection = $query->get();
		// 各行を配列に変換
		$arrayRows = $collection->map(function ($row) {
			return (array) $row;
		});
		// コレクション → 配列
		$rows = $arrayRows->toArray();

		// exportクラス
		$export = new MachineAggregatorExport($rows);
		$writer = $export->writer();

		// Excel をブラウザに直接ストリーム出力するレスポンス
		return new StreamedResponse(
			// ブラウザへ Excel を直接書き込む処理
			function () use ($writer) {
				$writer->save('php://output');  // 一時ファイルを作らず直接送信
			},
			// HTTP ステータスコード
			200,
			// ダウンロード用ヘッダー
			[
				'Content-Type'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				'Content-Disposition' => 'attachment; filename="machine_aggregator.xlsx"',
			]
		);

	}


}