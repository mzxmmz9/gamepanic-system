<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	protected $fillable = [
		'answer_id',
		'user_id',
		'content',
	];

	public function answer()
	{
		return $this->belongsTo(Answer::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}


}
