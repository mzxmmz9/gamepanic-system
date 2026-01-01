<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViewMachineAggregator extends Model
{
	protected $table = 'view_machine_aggregator';

	public $timestamps = false;

	protected $fillable = [
		'machine_code',
		'machine_name',
		'downtime_start',
		'downtime_end',
		'branch_id',
		'branch_name',
		'category_id',
		'category_name',
	];
}