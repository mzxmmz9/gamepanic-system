<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		DB::table('companies')->insert([
			['name' => '株式会社レジャラン'],
			['name' => '株式会社山崎屋'],
			['name' => '株式会社コンフォート'],
			['name' => '株式会社ＮＥＷＳ'],
			['name' => 'その他']
		]);
	}

}
