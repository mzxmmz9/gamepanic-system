<?php

// app/Models/Like.php
namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
	protected $fillable = [
		'user_id',
		'post_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
}