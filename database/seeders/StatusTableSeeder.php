<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('statuses')->insert([
			['name' => '稼働'],
			['name' => '休止'],
			['name' => '停止'],
			['name' => '暫定'],
			['name' => '移動中'],
			['name' => '様子見稼働'],
			['name' => '原因調査中'],
			['name' => '見積り取得中'],
			['name' => '返却待ち'],
			['name' => '発送待ち'],
		]);
	}
}
