<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-slate-800 leading-tight tracking-tight">
			投稿詳細
		</h2>
	</x-slot>

	<div class="max-w-4xl min-w-max mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8">

		<!-- ステータス -->
		<div>
			@if ($post->is_solved)
				<span class="inline-block bg-green-50 text-green-700 font-medium px-3 py-1 rounded-full text-sm border border-green-200">
					解決済
				</span>
			@else
				<span class="inline-block bg-red-50 text-red-700 font-medium px-3 py-1 rounded-full text-sm border border-red-200">
					未解決
				</span>
			@endif
		</div>

		<!-- 投稿内容 -->
		<div class="bg-white border border-slate-200 rounded-lg shadow-sm p-6 space-y-4">
			<h2 class="text-2xl font-bold text-slate-800">{{ $post->title }}</h2>
			<p class="text-sm text-slate-600">投稿者: {{ $post->user->name }}</p>

			@foreach ($post->images as $image)
				<img src="{{ $image->path }}" alt="投稿画像"
					 class="mt-2 rounded-md border border-slate-200 max-w-full">
			@endforeach

			<p class="text-slate-700 whitespace-pre-line">{{ $post->content }}</p>
			<small class="text-sm text-slate-500">投稿日: {{ $post->created_at->format('Y-m-d H:i') }}</small>

			<div class="flex flex-wrap gap-2 mt-4">

				@can('update', $post)
					<a href="{{ route('posts.edit', $post->id) }}"
					   class="btn btn-primary text-white">
						編集する
					</a>
				@endcan

				@csrf
				<button
					class="bookmark-toggle inline-block bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium px-4 py-2 rounded border border-slate-300 transition"
					data-post-id="{{ $post->id }}"
					data-bookmarked="{{ $isBookmarked ? 'true' : 'false' }}"
				>
					{{ $isBookmarked ? 'ブックマーク解除' : 'ブックマーク' }}
				</button>

				<form method="POST" action="{{ route('posts.destroy', $post->id) }}"
					  onsubmit="return confirm('本当に削除しますか？');">
					@csrf
					@method('DELETE')
					<button type="submit"
							class="inline-block bg-red-50 hover:bg-red-100 text-red-700 text-sm font-medium px-4 py-2 rounded border border-red-300 transition">
						削除
					</button>
				</form>
			</div>
		</div>

		<!-- ベストアンサー -->
		@if ($bestAnswer)
			<div class="bg-yellow-50 border border-yellow-200 rounded-lg p-5 shadow-sm space-y-2">
				<h4 class="text-lg font-semibold text-yellow-700">解決策</h4>
				<p class="text-slate-700">{{ $bestAnswer->comment }}</p>
				<small class="text-sm text-slate-500">by {{ $bestAnswer->user->name }}</small>

				@if ($bestAnswer->replies->count())
					<ul class="mt-3 ml-4 border-l border-yellow-200 pl-3 space-y-2">
						@foreach ($bestAnswer->replies as $reply)
							<li class="text-sm text-slate-700">
								<strong>{{ $reply->user->name }}:</strong> {{ $reply->content }}
							</li>
						@endforeach
					</ul>
				@endif
			</div>
		@endif

		<!-- 回答一覧 -->
		<h4 class="text-lg font-semibold text-slate-800">回答一覧</h4>

		<ul class="space-y-4">
			@forelse ($otherAnswers as $answer)
				<li class="bg-white border border-slate-200 rounded-lg p-4 shadow-sm space-y-3">

					@foreach ($answer->images as $image)
						<img src="{{ $image->path }}" alt="画像"
							 class="rounded-md border border-slate-200 max-w-full">
					@endforeach

					<p class="text-slate-700">{{ $answer->comment }}</p>
					<small class="text-sm text-slate-500">by {{ $answer->user->name }}</small>

					@can('markBest', $answer)
						<form method="POST" action="{{ route('answers.best', $answer->id) }}"
							  class="mt-2"
							  onsubmit="return confirm('この回答を解決策に決定しますか？')">
							@csrf
							<button type="submit" class="text-indigo-600 hover:underline text-sm">
								この回答で解決した
							</button>
						</form>
					@endcan

					<!-- レス折り畳み -->
					<div x-data="{ open: false }" class="mt-2">
						<button @click="open = !open"
								class="text-sm text-blue-600 hover:underline">
							レスポンス {{ $answer->replies->count() }} 件表示
						</button>

						<div x-show="open" x-transition
							 class="mt-2 ml-4 border-l border-slate-200 pl-3 space-y-2">

							@if ($answer->replies->count())
								@foreach ($answer->replies as $reply)
									<div class="text-sm text-slate-700">
										<strong>{{ $reply->user->name }}:</strong> {{ $reply->content }}
									</div>
								@endforeach
							@else
								<p class="text-sm text-slate-400">レスポンスはありません。</p>
							@endif

							@auth
								@if (auth()->id() === $answer->user_id || auth()->id() === $post->user_id)
									<form method="POST" action="{{ route('replies.store') }}"
										  class="mt-3 space-y-2">
										@csrf
										<input type="hidden" name="answer_id" value="{{ $answer->id }}">
										<textarea name="content" rows="2"
												  class="w-full border border-slate-300 rounded px-3 py-2 text-sm"
												  placeholder="この回答にコメントする" required></textarea>
										<button type="submit"
												class="bg-slate-800 text-white px-4 py-1 rounded text-sm hover:bg-slate-700 transition">
											送信する
										</button>
									</form>
								@endif
							@endauth
						</div>
					</div>
				</li>
			@empty
				<li class="text-slate-500">回答はまだありません</li>
			@endforelse
		</ul>

		<!-- 回答フォーム -->
		@auth
			<div class="mt-8 bg-white border border-slate-200 rounded-lg p-6 shadow-sm space-y-4">
				<h4 class="text-lg font-semibold text-slate-800">回答する</h4>
				<!-- 画像選択 -->
				<form method="POST" action="/images/temp" enctype="multipart/form-data">
					@csrf
					<input type="file" name="image" id="imageInput" multiple
						   class="block w-full text-sm text-slate-700">
				</form>
				<!-- テキスト入力 -->
				<form method="POST" action="{{ route('answers.confirm') }}" class="space-y-3">
					@csrf
					<input type="hidden" name="post_id" value="{{ $post->id }}">

					<textarea name="content" rows="4"
						class="w-full border border-slate-300 rounded px-4 py-2 text-sm
							   focus:outline-none focus:ring-2 focus:ring-indigo-500"
						placeholder="回答内容を入力してください">{{ old('content') }}</textarea>

					<button type="submit"
							class="btn btn-secondary">
						確認画面へ
					</button>
				</form>
			</div>
		@endauth

	</div>
</x-app-layout>