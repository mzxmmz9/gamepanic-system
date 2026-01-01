<?php

namespace App\Exports;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MachineAggregatorExport
{
	protected array $rows;

	public function __construct(array $rows)
	{
		$this->rows = $rows;
	}

	public function build(): Spreadsheet
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// ヘッダー
		$sheet->fromArray([
			[
				'店舗',
				'マシンコード',
				'マシン名',
				'休止開始時間',
				'休止終了時間',
				'休止時間 (h)',
				'損失額 (円)',
			]
		], null, 'A1');

		$row = 2;

		foreach ($this->rows as $item) {

			// 休止時間
			$hours = $this->calculateDowntimeHours(
				$item['downtime_start'],
				$item['downtime_end']
			);
			// 損失額
			$loss = $this->calculateLossAmount($hours);

			// Excel 出力
			$sheet->setCellValue("A{$row}", $item['branch_name']);
			$sheet->setCellValue("B{$row}", $item['machine_code']);
			$sheet->setCellValue("C{$row}", $item['machine_name']);
			$sheet->setCellValue("D{$row}", \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(Carbon::parse($item['downtime_start'])));
			$sheet->setCellValue("E{$row}", $item['downtime_end']
				? \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(Carbon::parse($item['downtime_end']))
				: null
			);
			$sheet->setCellValue("F{$row}", $hours);
			$sheet->setCellValue("G{$row}", $loss);

			// セルのフォーマットを日付に設定
			$sheet->getStyle("D{$row}:E{$row}")
				  ->getNumberFormat()
				  ->setFormatCode('yyyy-mm-dd hh:mm:ss');

			$row++;
		}

		// 列幅自動調整
		foreach (range('A', 'G') as $col) {
			$sheet->getColumnDimension($col)->setAutoSize(true);
		}

		return $spreadsheet;
	}

	/**
	 * 営業時間内の休止時間(h)を計算
	 */
	private function calculateDowntimeHours(string $startAt, ?string $endAt): float
	{
		$start = Carbon::parse($startAt);
		$end   = $endAt ? Carbon::parse($endAt) : Carbon::now();

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

		return round($businessMinutes / 60, 2);
	}

	/**
	 * 損失額を計算（いったん1時間1000円）
	 */
	private function calculateLossAmount(float $hours): int
	{
		return (int) round($hours * 1000);
	}

	public function writer(): Xlsx
	{
		return new Xlsx($this->build());
	}
}