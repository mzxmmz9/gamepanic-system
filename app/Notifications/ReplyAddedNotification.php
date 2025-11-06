<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class ReplyAddedNotification extends Notification
{
	use Queueable;

	public function __construct(public Reply $reply) {}

	public function via(object $notifiable): array
	{
		return ['database'];
	}

	public function toArray(object $notifiable): array
	{
		return [
			'message' => 'あなたの回答にレスポンスがつきました',
			'reply_id' => $this->reply->id,
			'answer_id' => $this->reply->answer_id,
			'post_id' => $this->reply->answer->post_id,
		];
	}
}
