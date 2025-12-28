<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Services\ImageService;

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

	//確認画面
	public function confirm(Request $request, ImageService $imageService)
	{
		// バリデーション
		$validated = $request->validate([
			'title'   => 'required|string|max:255',
			'content' => 'required|string',
			'images.*' => 'nullable|image|max:5120', // 5MB
		]);

		// 画像を temp に保存して session に保持
		$tempImages = session('post_temp_images', []);

		if ($request->hasFile('images')) {
			foreach ($request->file('images') as $file) {
				$tempImages[] = $imageService->saveTemp($file);
			}
			session(['post_temp_images' => $tempImages]);
		}

		// confirm.blade.php に渡す
		return view('posts.confirm', [
			'title'       => $validated['title'],
			'content'     => $validated['content'],
			'temp_images' => $tempImages,
		]);
	}

	//投稿実行
	public function store(Request $request, ImageService $imageService)
	{
		// タイトル・本文は hidden で送られてくる
		$validated = $request->validate([
			'title'   => 'required|string|max:255',
			'content' => 'required|string',
		]);

		// confirm() で session に保存した temp 画像を取得
		$tempImages = session('post_temp_images', []);

		// 投稿を作成
		$post = Post::create([
			'user_id' => auth()->id(),
			'title'   => $validated['title'],
			'content' => $validated['content'],
		]);

		// 画像を本保存（JPEG圧縮）して紐付け
		foreach ($tempImages as $tempPath) {
			$newPath = $imageService->moveToPermanent($tempPath);
			$post->images()->create([
				'path' => $newPath,
			]);
		}

		// temp をクリア
		session()->forget('post_temp_images');

		return redirect()->route('posts.show', $post->id)
						->with('success', '投稿が完了しました');
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
