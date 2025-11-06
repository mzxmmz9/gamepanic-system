<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewMachine extends Model
{
	//
	protected $table = 'view_machines';
	protected $primaryKey = 'code';
	public $incrementing = false;
	public $timestamps = false;

	public static function findCode(string $code)
	{
		return self::where('code', $code)->first();
	}


}
