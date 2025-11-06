<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BoardsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		$path = database_path('data/boards.csv');  // ファイルのパス

        $rows = array_map('str_getcsv', file($path)); // CSVを配列で読み込む
		$header = array_shift($rows); // 1行目をヘッダーとして抽出

		foreach ($rows as $row) {
			$data = array_combine($header, $row); // ヘッダーと値を結合
			DB::table('boards')->insert($data);
		}
	}

}
