<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">
			{{ __('Index') }}
		</h2>
	</x-slot>

	<div class="space-y-4 mt-6">
		@foreach ($bookmarks as $bookmark)
			@php
				$post = $bookmark->post;
			@endphp

			<div class="bg-white shadow-sm border rounded-lg p-4 flex items-center justify-between">
				<div>
					<a href="{{ route('posts.show', $post->id) }}" class="text-lg font-semibold text-blue-600 hover:underline">
						{{ $post->title }}
					</a>
				</div>

				<div class="flex items-center space-x-2">
					<!-- bookmark toggle -->
					<button
						class="px-3 py-1 text-sm font-medium rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 transition bookmark-toggle"
						data-post-id="{{ $post->id }}"
						data-bookmarked="{{ in_array($post->id, $bookmarkedIds) ? 'true' : 'false' }}"
					>
						{{ in_array($post->id, $bookmarkedIds) ? '🔖 ブックマーク解除' : '📌 ブックマーク' }}
					</button>

					<!-- delete -->
					<form method="POST" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('本当に削除しますか？');">
						@csrf
						@method('DELETE')
						<button type="submit"
							class="px-3 py-1 text-sm font-medium rounded-md border border-red-300 bg-red-100 text-red-700 hover:bg-red-200 transition"
						>
							🗑️ 削除
						</button>
					</form>
				</div>
			</div>
		@endforeach
	</div>
</x-app-layout>