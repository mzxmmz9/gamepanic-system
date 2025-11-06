<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		DB::table('branches')->insert([
			['name' => 'あべのアポロ店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => 'オリエントパーク店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => 'オリナス錦糸町店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => 'つくば（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '稲毛店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '京都（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '甲府（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '堺（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '三郷（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '市川妙典店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '上越店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '新習志野店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '大宮南銀店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '大高店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '大津店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '津田沼（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '内田橋店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => ''],
			['name' => '穂積店（レジャラン）', 'postcode' => '', 'address' => '', 'note' => '']
		]);

	}
}
