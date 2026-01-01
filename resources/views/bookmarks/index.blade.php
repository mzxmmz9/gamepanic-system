<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-slate-800 tracking-tight">
			{{ __('Index') }}
		</h2>
	</x-slot>

	<div class="space-y-4 mt-6 max-w-4xl mx-auto px-4">
		@foreach ($bookmarks as $bookmark)
			@php
				$post = $bookmark->post;
			@endphp

			<div class="bg-white border border-slate-200 rounded-xl shadow-sm p-5 flex items-center justify-between hover:shadow-md transition">
				<div>
					<a href="{{ route('posts.show', $post->id) }}"
					   class="text-lg font-semibold text-indigo-600 hover:text-indigo-700 hover:underline transition">
						{{ $post->title }}
					</a>
				</div>

				<div class="flex items-center space-x-2">
					<!-- bookmark toggle -->
					<button
						class="px-3 py-1 text-sm font-medium rounded-md border border-slate-300 bg-slate-100 hover:bg-slate-200 text-slate-700 transition bookmark-toggle"
						data-post-id="{{ $post->id }}"
						data-bookmarked="{{ in_array($post->id, $bookmarkedIds) ? 'true' : 'false' }}"
					>
						{{ in_array($post->id, $bookmarkedIds) ? 'ブックマーク解除' : 'ブックマーク' }}
					</button>

					<!-- delete -->
					<form method="POST" action="{{ route('posts.destroy', $post->id) }}" onsubmit="return confirm('本当に削除しますか？');">
						@csrf
						@method('DELETE')
						<button type="submit"
							class="px-3 py-1 text-sm font-medium rounded-md border border-red-300 bg-red-50 text-red-700 hover:bg-red-100 transition"
						>
							削除
						</button>
					</form>
				</div>
			</div>
		@endforeach
	</div>
</x-app-layout>