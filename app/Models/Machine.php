<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Role;
use App\Models\User;
use App\Models\ViewMachine;
use Illuminate\Support\Facades\DB;

class Machine extends Model
{
	protected $primaryKey = 'code';
	protected $keyType = 'string';
	public $incrementing = false;

	//リレーション
	public function branch(){ return $this->belongsTo(MachineBranch::class, 'branch_id', 'id'); }

	//選択可能マシン
	public static function visibleTo(User $user)
	{
		if (in_array($user->role, [Role::Developer->value, Role::Admin->value])) {
			return self::with('branch')->get(); // 全部見える
		}
		return self::where('branch_id', $user->branch_id)->with('branch')->get(); // 自店舗のみ
	}
	
}
