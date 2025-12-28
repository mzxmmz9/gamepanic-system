<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
	use AuthorizesRequests;

	// 一覧
	public function index(Request $request)
	{
		// 検索ワード取得
		$keyword = $request->input('keyword');

		// 投稿取得（検索条件を追加）
		$posts = Post::query()
			->when($keyword, function ($query, $keyword) {
				$query->where(function ($q) use ($keyword) {
					$q->where('title', 'like', "%{$keyword}%")
					  ->orWhere('content', 'like', "%{$keyword}%");
				});
			})
			->latest()
			->paginate(10);

		// ブックマーク済みID
		$bookmarkedIds = auth()->check()
			? auth()->user()->bookmarks()->pluck('post_id')->toArray()
			: [];

		return view('posts.index', compact('posts', 'bookmarkedIds', 'keyword'));
	}

	//詳細表示
	public function show(Post $post)
	{
		$isBookmarked = auth()->user()
			->bookmarks()
			->where('post_id', $post->id)
			->exists();
		$bestAnswer = $post
			->answers()
			->where('is_best', true)
			->with('user', 'replies.user') // ユーザー情報と返信もまとめて取得
			->first();
		$otherAnswers = $post
			->answers()
			->where('is_best', false)
			->latest()
			->get();

		session()->forget('pending_images');

		return view('posts.show', compact('post', 'isBookmarked', 'bestAnswer', 'otherAnswers'));
	}

	//投稿フォーム
	public function create()
	{
		return view('posts.create');
	}

	//投稿実行
	public function store(Request $request)
	{

		$request->validate([
			'title'   => 'required|string|max:255',
			'content' => 'required|string',
			'images' => 'nullable|array|max:3',         // 最大3枚
			'images.*' => 'image|mimes:jpg,jpeg,png|max:2048' // 各画像の制限
		]);

		$post = Post::create([
			'title'    => $request->title,
			'content'  => $request->content,
			'user_id'  => auth()->id(),
			'store_id' => auth()->user()->store_id,
		]);

		foreach ($request->file('images') ?? [] as $file) {
			Image::saveFromUpload($file, $post); // 新規追加 → 圧縮
			$post->images()->create([
				'path' => Storage::url("images/{$filename}"),
			]);
		}

		return redirect()->route('posts.show', $post)->with('success', '投稿が完了しました');
	}

	//編集
	public function edit(Post $post)
	{
		$this->authorize('update', $post);
		return view('posts.edit', compact('post'));
	}

	//更新
	public function update(Request $request, Post $post)
	{
		$this->authorize('update', $post); // 投稿者本人のみ

		$request->validate([
			'title'   => 'required|string|max:255',
			'content' => 'required|string',
			'images' => 'nullable|array|max:3',         // 最大3枚
			'images.*' => 'image|mimes:jpg,jpeg,png|max:2048' // 各画像の制限
		]);

		$post->update([
			'title'   => $request->title,
			'content' => $request->content,
		]);

		foreach ($request->file('images') ?? [] as $index => $file) {
			$image = $post->images[$index];
			$image->delete();                     // 既存削除
			Image::saveFromUpload($file, $post);  // 差し替え → 圧縮
		}

		return redirect()->route('posts.show', $post)->with('success', '投稿を更新しました');
	}
	
	//削除
	public function destroy(Post $post)
	{
		$this->authorize('delete', $post);
		$post->images->each->delete();//画像連動削除
		$post->delete();
		return redirect()->route('posts.index')->with('success', '投稿を削除しました');
	}

}
