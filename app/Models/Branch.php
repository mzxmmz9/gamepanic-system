<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
	protected $fillable = [
		'code',		// 支店コード
		'name',		// 支店名
		'postcode',//郵便番号
		'address',	// 住所
		'note',	// 備考コメント
	];

	public function machines()
	{
		return $this->hasMany(Machine::class);
	}

}