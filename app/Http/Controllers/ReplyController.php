<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Reply;

class ReplyController extends Controller
{
	//
	public function store(Request $request)
	{
		$request->validate([
			'answer_id' => 'required|exists:answers,id',
			'content' => 'required|string|max:1000',
		]);

		// 質問者または回答者以外は403
		$answer = Answer::with('post')->findOrFail($request->answer_id);
		if (
			auth()->id() !== $answer->user_id &&
			auth()->id() !== $answer->post->user_id
		) {
			abort(403);
		}

		$reply = Reply::create([
			'answer_id' => $request->answer_id,
			'user_id' => auth()->id(),
			'content' => $request->content,
		]);

		// 回答者に通知を送る（自分以外なら）
		$answerAuthor = $reply->answer->user;
		if ($answerAuthor->id !== auth()->id()) {
			$answerAuthor->notify(new ReplyAddedNotification($reply));
		}

		return back()->with('success', 'レスポンスを送信しました');
	}
}
