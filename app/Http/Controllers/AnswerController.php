<?php
namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Notifications\BestAnswerChosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\ImageService;

class AnswerController extends Controller
{
	use AuthorizesRequests;

	public function confirm(Request $request, ImageService $imageService)
	{
		$request->validate([
			'post_id' => 'required|exists:posts,id',
			'content' => 'required|string|max:1500',
			'images.*' => 'nullable|image',
		]);

		$pendingImages = session('pending_images', []);

		if ($request->hasFile('images')) {
			foreach ($request->file('images') as $file) {
				$pendingImages[] = $imageService->saveTemp($file);
			}
			session(['pending_images' => $pendingImages]);
		}

		return view('answers.confirm', [
			'post' => Post::find($request->post_id),
			'content' => $request->content,
			'temp_images' => $pendingImages,
		]);
	}

	public function back(Request $request)
	{
		// 入力内容を復元
		session()->flashInput($request->only('content'));

		// 確認画面から戻ったフラグ
		session()->put('_from_confirm', true);

		// 画像も復元（hidden で送られてきた temp_images[]）
		if ($request->has('temp_images')) {
			session()->put('pending_images', $request->temp_images);
		}

		return redirect()->route('posts.show', $request->input('post_id'));
	}

	
	public function store(Request $request, ImageService $imageService)
	{
		$answer = Answer::create([
			'post_id' => $request->post_id,
			'user_id' => Auth::id(),
			'comment' => $request->content,
		]);

		foreach (session()->pull('pending_images', []) as $tempPath) {
			$newPath = $imageService->moveToPermanent($tempPath);

			$answer->images()->create([
				'path' => Storage::url($newPath),
			]);
		}

		return redirect()->route('posts.show', $request->post_id)
			->with('success', '回答を投稿しました');
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