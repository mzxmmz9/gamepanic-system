<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Machine_planTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $path = database_path('data/machine_plan.csv');  // ファイルのパス

        // UTF-8 BOMを検出して除去
        $content = file_get_contents($path);
        if (substr($content, 0, 3) === "\xEF\xBB\xBF") {
            $content = substr($content, 3);
        }

        $rows = array_map('str_getcsv', file($path)); // CSVを配列で読み込む
        $header = array_shift($rows); // 1行目をヘッダーとして抽出

        foreach ($rows as $row) {
            $data = array_combine($header, $row);
            $machineCode = $data['machine_code'];
            $planId = $data['plan_id'];
            if (!empty($planId) && DB::table('plans')->where('id', $planId)->exists()) {
                DB::table('machine_plans')->insert([
                    'machine_code' => $machineCode,
                    'plan_id' => $planId,
                ]);
            }
        }
    }
}
