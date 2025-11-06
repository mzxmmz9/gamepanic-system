<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FailureReport extends Model
{
	protected $fillable = [
		'id',
		'branch_id',
		'occurred_at',
		'occurred_by',
		'resumed_at',
		'resumed_by',
		'machine_code',
		'machine_name',
		'st_num',
		'process',
		'malfunction',
		'note',
	];
}
