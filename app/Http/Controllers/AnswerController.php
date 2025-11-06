<?php
namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Notifications\BestAnswerChosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AnswerController extends Controller
{
	use AuthorizesRequests;

	public function confirm(Request $request)
	{
		$request->validate([
			'post_id' => 'required|exists:posts,id',
			'content' => 'required|string',
			'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048', // 各ファイルの型＆サイズ制限（2MB）
		]);

		$post = Post::findOrFail($request->input('post_id'));
		$content = $request->input('content');
		$pendingImages = session('pending_images', []);

		return view('answers.confirm', compact('post', 'content', 'pendingImages'));
	}

	public function back(Request $request)
	{
		session()->flashInput($request->only('content'));
		session()->put('_from_confirm', true);

		return redirect()->route('posts.show', $request->input('post_id'));
	}

	public function store(Request $request)
	{
		$answer = Answer::create([
			'post_id' => $request->post_id,
			'user_id' => Auth::id(),
			'comment' => $request->content,
		]);

		foreach (session()->pull('pending_images', []) as $filename) {
			$storagePath = "images/{$filename}"; // ファイル保存先
			$urlPath = "images/{$filename}"; // 表示用URL

			Storage::disk('public')->move("temp-images/{$filename}", $storagePath);
			$answer->images()->create([
				'path' => Storage::url($urlPath),
			]);
		}
		return redirect()->route('posts.show', $request->input('post_id'))->with('success', '回答を投稿しました');
	}

	public function markBest(Answer $answer)
	{
		$this->authorize('markBest', $answer);

		// 既存ベスト回答を解除
		Answer::where('post_id', $answer->post_id)->update(['is_best' => false]);

		// この回答をベストに設定
		$answer->update(['is_best' => true]);

		// 投稿も解決状態に更新
		$answer->post->update(['is_solved' => true]);

		return back()->with('success', '解決策を選び、投稿を解決済みに設定しました');
	}

}