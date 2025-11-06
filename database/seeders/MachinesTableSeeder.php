<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MachinesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */


	public function run()
	{
		$path = database_path('data/machines.csv'); // ファイルのパス
		$handle = fopen($path, 'r');

		if (!$handle) {
			logger('⚠️ ファイル読み込み失敗: ' . $path);
			return;
		}

		// ファイル読み込みと文字コード変換
		$content = file_get_contents($path);
		if (substr($content, 0, 3) === "\xEF\xBB\xBF") {
			$content = substr($content, 3); // BOM除去
		}
		// 一時ファイルに保存して、fgetcsv用に再オープン
		$tempPath = storage_path('app/temp_machines.csv');
		file_put_contents($tempPath, $content);

		$handle = fopen($tempPath, 'r');
		$header = null;

		while (($row = fgetcsv($handle)) !== false) {
			// 改行を「、」に変換（セル内のみ）
			$row = array_map(function ($value) {
				return str_replace(["\r\n", "\r", "\n"], '、', $value);
			}, $row);

			if (!$header) {
				$header = $row;
				continue;
			}

			if (count($row) !== count($header)) {
				logger('⚠️ カラム数不一致 → ' . json_encode($row));
				continue;
			}

			$data = array_combine($header, $row);
			DB::table('machines')->insert($data);
		}

		fclose($handle);
	}
}
