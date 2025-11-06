<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image as Editor;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
	protected $fillable = ['path'];

	public function imageable()
	{
		return $this->morphTo();
	}

	// 連動削除
	protected static function booted()
	{
		static::deleting(function ($image) {
			if ($image->path) {
				$storagePath = str_replace('/storage/', 'public/', $image->path);
				Storage::delete($storagePath);
			}
		});
	}


}