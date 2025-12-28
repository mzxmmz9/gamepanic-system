<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-slate-800 leading-tight tracking-tight">
			{{ __('Index') }}
		</h2>
	</x-slot>

	<div class="max-w-4xl min-w-max mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8">

		<section class="actions flex justify-end">
			<a href="{{ route('posts.create') }}"
			   class="btn btn-primary text-white w-full">
				+ 新しい投稿
			</a>
		</section>
		<div class="max-w-4xl mx-auto mt-8 px-4 space-y-4">
			@foreach ($posts as $post)
				<div class="bg-white border border-slate-200 rounded-lg shadow-sm p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between hover:shadow-md transition">
					<div class="mb-3 sm:mb-0">
						<a href="{{ route('posts.show', $post->id) }}"
						   class="text-lg font-semibold text-indigo-600 hover:text-indigo-700 hover:underline transition">
							{{ $post->title }}
						</a>
					</div>

					<div class="flex items-center space-x-2">
						<!-- bookmark toggle -->
						@csrf
						<button
							class="bookmark-toggle px-3 py-1 text-sm font-medium rounded-md border border-slate-300 bg-slate-100 hover:bg-slate-200 text-slate-700 transition"
							data-post-id="{{ $post->id }}"
							data-bookmarked="{{ in_array($post->id, $bookmarkedIds) ? 'true' : 'false' }}"
						>
							{{ in_array($post->id, $bookmarkedIds) ? 'ブックマーク解除' : 'ブックマーク' }}
						</button>

						<!-- edit -->
						<a href="{{ route('posts.edit', $post->id) }}"
						   class="px-3 py-1 text-sm font-medium rounded-md border border-amber-300 bg-amber-50 text-amber-700 hover:bg-amber-100 transition">
							編集
						</a>

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

			<!-- ページネーション -->
			<div class="mt-6">
				{{ $posts->links() }}
			</div>
		</div>

	</div>
</x-app-layout>