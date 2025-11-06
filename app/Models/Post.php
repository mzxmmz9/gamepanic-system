<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ← 論理削除（任意）

class Post extends Model
{
	use HasFactory;
	use SoftDeletes; // ← 論理削除を使いたいなら

	protected $fillable = [
		'title',
		'content',
		'user_id',
		'store_id', //投稿店舗
		'is_solved',//解決状態
	];

	// 📌 型変換（必要に応じて）
	protected $casts = [
		'created_at' => 'datetime',
		'updated_at' => 'datetime',
	];

	// 📌 投稿者とのリレーション
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	// 📌 店舗とのリレーション（任意）
	public function store()
	{
		return $this->belongsTo(Store::class);
	}

	public function answers()
	{
		return $this->hasMany(Answer::class);
	}

	public function images()
	{
		return $this->morphMany(Image::class, 'imageable');
	}
	
}