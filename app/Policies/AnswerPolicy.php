<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Answer;
use App\Models\User;

class AnswerPolicy
{
	/**
	 * Determine whether the user can view any models.
	 */
	public function viewAny(User $user): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can view the model.
	 */
	public function view(User $user, Answer $answer): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can create models.
	 */
	public function create(User $user): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can update the model.
	 */
	public function update(User $user, Answer $answer): bool
	{
		return $user->id === $answer->user_id;
	}

	public function delete(User $user, Answer $answer): bool
	{
		return $user->id === $answer->user_id;
	}

	/**
	 * Determine whether the user can restore the model.
	 */
	public function restore(User $user, Answer $answer): bool
	{
		return false;
	}

	/**
	 * Determine whether the user can permanently delete the model.
	 */
	public function forceDelete(User $user, Answer $answer): bool
	{
		return false;
	}

	public function markBest(User $user, Answer $answer): bool
	{
		// 投稿者だけがベスト回答を設定できる
		return $user->id === $answer->post->user_id;
	}
}
