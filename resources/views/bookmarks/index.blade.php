<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Index') }}
		</h2>
	</x-slot>

	<ul>
		@foreach ($bookmarks as $bookmark)
			@php
				$post = $bookmark->post;
			@endphp

			<li class="mb-4">
				<a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>

				<!-- bookmark toggle -->
				<button
					class="bookmark-toggle"
					data-post-id="{{ $post->id }}"
					data-bookmarked="{{ in_array($post->id, $bookmarkedIds) ? 'true' : 'false' }}"
				>
					{{ in_array($post->id, $bookmarkedIds) ? '🔖 ブックマーク解除' : '📌 ブックマーク' }}
				</button>

				<!-- delete -->
				<form method="POST" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('本当に削除しますか？');" style="display: inline;">
					@csrf
					@method('DELETE')
					<button type="submit">🗑️ 削除</button>
				</form>
			</li>
		@endforeach
	</ul>

</x-app-layout>