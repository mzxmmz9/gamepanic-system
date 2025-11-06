<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('plans')->insert([
			['name' => '０９プラン'],
			['name' => '１０プラン'],
			['name' => '２０プラン'],
			['name' => '４５プラン'],
			['name' => 'Ａプラン'],
			['name' => 'Ｃプラン'],
			['name' => 'ＥＸプラン'],
			['name' => 'ＥＸ＋'],
			['name' => 'ＮＥＸＴ'],
			['name' => 'ＮＥＸＴ４５'],
			['name' => 'ＮＥＸＴ５５'],
			['name' => 'ＭＩＸ'],
			['name' => 'Ｐ－ｒａｓ'],
			['name' => 'リニュー'],
			['name' => 'コースター'],
			['name' => 'トライアル'],
			['name' => 'スタンダード'],
			['name' => 'レギュラー'],
			['name' => 'アドバンス'],
			['name' => 'プレミアム'],
			['name' => '通常'],
			['name' => '年度更新'],
			['name' => '初期投資']
		]);
	}
}
