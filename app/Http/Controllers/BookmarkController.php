<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class BookmarkController extends Controller
{
	public function index()
	{
		$user = auth()->user();

		$bookmarks = $user
			->bookmarks()
			->with('post') // 投稿情報付き
			->latest()
			->paginate(10);

		$bookmarkedIds = $user
			->bookmarks()
			->pluck('post_id')
			->toArray();

		return view('bookmarks.index', compact('bookmarks', 'bookmarkedIds'));
	}
	
	public function toggle(Post $post)
	{
		$user = auth()->user();
		$existing = $user->bookmarks()->where('post_id', $post->id)->first();

		if ($existing) {
			$existing->delete();
		} else {
			$user->bookmarks()->create(['post_id' => $post->id]);
		}

		return response()->json(['status' => 'ok']);
	}

}
