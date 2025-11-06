<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			投稿詳細
		</h2>
	</x-slot>

	<div class="post-detail">
		@if ($post->is_solved)
			<span class="text-green-600 font-bold">解決済</span>
		@else
			<span class="text-red-600 font-bold">未解決</span>
		@endif

		<h2>{{ $post->title }}</h2>
		<p>投稿者: {{ $post->user->name }}</p>
		@foreach ($post->images as $image)
			<img src="{{ $image->path }}" alt="投稿画像">
		@endforeach
		<p>{{ $post->content }}</p>
		<small>投稿日: {{ $post->created_at->format('Y-m-d H:i') }}</small>

		{{-- 編集 --}}
		@can('update', $post)
			<a href="{{ route('posts.edit', $post->id) }}" class="button">✏️ 編集する</a>
		@endcan
		{{-- ブックマーク --}}
		@csrf
		<button
			class="bookmark-toggle"
			data-post-id="{{ $post->id }}"
			data-bookmarked="{{ $isBookmarked ? 'true' : 'false' }}"
		>
			{{ $isBookmarked ? '🔖 ブックマーク解除' : '📌 ブックマーク' }}
		</button>
		{{-- 削除 --}}
		<form method="POST" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('本当に削除しますか？');">
			@csrf
			@method('DELETE')
			<button type="submit">🗑️ 削除</button>
		</form>

		{{-- ベストアンサー --}}
		@if ($bestAnswer)
			<div class="mb-4 p-4 border border-yellow-400 bg-yellow-50 rounded">
				<h4 class="text-lg font-bold text-yellow-700">解決策</h4>
				<p>{{ $bestAnswer->comment }}</p>
				<small class="text-sm text-gray-600">by {{ $bestAnswer->user->name }}</small>
				{{-- 🔄 レス一覧表示（Answer → Reply） --}}
				@if ($bestAnswer->replies->count())
					<ul class="mt-3 ml-4 border-l pl-3">
						@foreach ($bestAnswer->replies as $reply)
							<li class="mb-2 text-sm text-gray-700">
								<strong>{{ $reply->user->name }}:</strong> {{ $reply->content }}
							</li>
						@endforeach
					</ul>
				@endif
			</div>
		@endif

		{{-- 回答一覧 --}}
		<h4 class="text-lg font-bold mb-2">回答一覧</h4>
		<ul>
			@forelse ($otherAnswers as $answer)
				<li class="mb-3 p-3 border rounded">
					@foreach ($answer->images as $image)
						<img src="{{ $image->path }}" alt="画像">
					@endforeach
					<p>{{ $answer->comment }}</p>
					<small class="text-sm text-gray-500">by {{ $answer->user->name }}</small>

					@can('markBest', $answer)
						<form method="POST" action="{{ route('answers.best', $answer->id) }}" class="mt-2"
							onsubmit="return confirm('この回答を解決策に決定しますか？')">
							@csrf
							<button type="submit" class="text-blue-600 hover:underline">✅ この回答で解決した</button>
						</form>
					@endcan

					{{-- 🔄 レス折り畳み表示 --}}
					<div x-data="{ open: false }" class="mt-2">
						<button @click="open = !open" class="text-sm text-blue-500 hover:underline">
							レスポンス {{ $answer->replies->count() }} 件表示
						</button>

						<div x-show="open" x-transition class="mt-2 ml-4 border-l pl-3">
							{{-- レス一覧 --}}
							@if ($answer->replies->count())
								@foreach ($answer->replies as $reply)
									<div class="mb-2 text-sm text-gray-700">
										<strong>{{ $reply->user->name }}:</strong> {{ $reply->content }}
									</div>
								@endforeach
							@else
								<p class="text-sm text-gray-400">レスポンスはありません。</p>
							@endif

							{{-- ✍️ レス投稿フォーム --}}
							@auth
								@if (
									auth()->id() === $answer->user_id ||  // 回答者
									auth()->id() === $post->user_id       // 質問者
								)
									<form method="POST" action="{{ route('replies.store') }}" class="mt-3">
										@csrf
										<input type="hidden" name="answer_id" value="{{ $answer->id }}">
										<textarea name="content" rows="2" class="w-full border rounded p-2" placeholder="この回答にコメントする" required></textarea>
										<button type="submit" class="mt-1 bg-gray-800 text-white px-3 py-1 rounded text-sm">送信する</button>
									</form>
								@endif
							@endauth
						</div>
					</div>
				</li>
			@empty
				<li>回答はまだありません</li>
			@endforelse
		</ul>

		{{-- 回答フォーム --}}
		@auth
			<div class="mt-6">
				<h4 class="text-lg font-bold">回答する</h4>
				<form method="POST" action="/images/temp" enctype="multipart/form-data">
					@csrf
					<input type="file" name="image" id="imageInput" multiple>
				</form>
				<form method="POST" action="{{ route('answers.confirm') }}">
					@csrf
					<input type="hidden" name="post_id" value="{{ $post->id }}">
					<input type="text" name="content" value="{{ old('content') }}">
					<button type="submit">確認画面へ</button>
				</form>
			</div>
		@endauth

	</div>

</x-app-layout>