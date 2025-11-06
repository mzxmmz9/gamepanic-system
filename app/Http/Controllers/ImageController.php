<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ImageController extends Controller
{
	// 一時ストレージへのアップロード
	public function temporaryStore(Request $request)
	{
		$file = $request->file('image');

		$filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
		$path = $file->storeAs('temp-images', $filename, 'public');

		// 一時保存したファイルパスをセッションに記録
		session()->push('pending_images', $filename);

		return response()->json(['filename' => $filename]);
	}

	// メインストレージへの保存
	public function store(Request $request)
	{
		$post = Post::create([
			'title'   => $request->title,
			'content' => $request->content,
			'user_id' => auth()->id(),
			'store_id' => auth()->user()->store_id,
		]);

		// セッションから一時画像名を取得
		$pending = session()->pull('pending_images', []);

		foreach ($pending as $filename) {
			$tempPath = 'temp-images/' . $filename;
			$finalPath = 'images/' . $filename;

			// 移動
			Storage::disk('public')->move($tempPath, $finalPath);

			// モデルに紐づけ（Polymorphic）
			$post->images()->create([
				'path' => Storage::url("images/{$filename}"),
			]);

			\Log::info('保存先:', ['path' => "storage/app/public/images/{$filename}"]);
			\Log::info('URL:', ['url' => Storage::url("images/{$filename}")]);

		}

		return redirect()->route('posts.show', $post)->with('success', '完了');
	}

}
