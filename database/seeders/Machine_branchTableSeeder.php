<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Machine_branchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $path = database_path('data/machine_branch.csv');  // ファイルのパス

        // UTF-8 BOMを検出して除去
        $content = file_get_contents($path);
        if (substr($content, 0, 3) === "\xEF\xBB\xBF") {
            $content = substr($content, 3);
        }

        $rows = array_map('str_getcsv', file($path)); // CSVを配列で読み込む
        $header = array_shift($rows); // 1行目をヘッダーとして抽出

        foreach ($rows as $row) {
            $data = array_combine($header, $row); // ヘッダーと値を結合
            DB::table('machine_branches')->insert($data);
        }
    }
}
