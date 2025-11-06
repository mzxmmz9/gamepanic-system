<?php

// app/Models/Answer.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $fillable = [
		'post_id',
		'user_id',
		'comment',
		'is_best',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function question()
	{
		return $this->belongsTo(Post::class, 'question_id'); // Q&AがPostなら
	}

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
	
	public function bestAnswer()
	{
		return $this->answers()->where('is_best', true)->first();
	}

	public function replies()
	{
		return $this->hasMany(Reply::class);
	}

	public function images()
	{
		return $this->morphMany(Image::class, 'imageable');
	}
	
}
