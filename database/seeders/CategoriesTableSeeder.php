<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('categories')->insert([
			['name' => 'カード'],
			['name' => 'カードダス'],
			['name' => 'ガン'],
			['name' => 'シール'],
			['name' => 'スポーツ'],
			['name' => 'その他'],
			['name' => 'スポーツ'],
			['name' => 'パチスロ'],
			['name' => 'パチンコ'],
			['name' => 'パンチ'],
			['name' => 'ビデオ'],
			['name' => 'メダル'],
			['name' => 'メダル専用'],
			['name' => 'メダル貸機'],
			['name' => 'モグラ'],
			['name' => '音響'],
			['name' => '景品'],
			['name' => '自販機'],
			['name' => '占い'],
			['name' => '操縦']
		]);
	}
}
