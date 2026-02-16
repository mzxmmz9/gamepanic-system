<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;

class BookmarkController extends Controller
{
	/*
		ブックマーク一覧表示
	*/
	public function index()
	{
		// ログインユーザ取得
		$user = auth()->user();

		// ユーザのブックマーク一覧取得
		$bookmarks = $user
			->bookmarks()
			->with('post')
			->latest()
			->paginate(10);

		// ブックマーク済みの投稿IDを配列で取得
		$bookmarkedIds = $user
			->bookmarks()
			->pluck('post_id')
			->toArray();

		return view('bookmarks.index', compact('bookmarks', 'bookmarkedIds'));
	}
	
	/*
		ブックマーク登録/解除トグル
	*/
	public function toggle(Post $post)
	{
		// ログインユーザ取得
		$user = auth()->user();

		// ブックマーク済か確認
		$existing = $user->bookmarks()->where('post_id', $post->id)->first();

		if ($existing) {
			// ブックマーク済なら解除
			$existing->delete();
		} else {
			// 未ブックマークなら登録
			$user->bookmarks()->create(['post_id' => $post->id]);
		}

		// フロントのJavaScriptに値を渡す
		return response()->json(['status' => 'ok']);
	}

}
