<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{ __('Dashboard') }}
		</h2>
	</x-slot>

	<div class="max-w-4xl min-w-max mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8">

		<!-- 直近の投稿 -->
		<section class="latest-posts">
			<h2 class="text-lg font-semibold text-gray-700 mb-4 border-b pb-2">直近の投稿</h2>
			<ul class="space-y-4">
				@forelse ($latestPosts as $post)
					<li class="post bg-white border border-gray-200 rounded p-4 shadow-sm hover:shadow-md transition">
						<a href="{{ route('posts.show', $post->id) }}" class="text-gray-800 hover:text-blue-600">
							<strong class="block text-base font-medium">{{ $post->title }}</strong>
							<small class="text-sm text-gray-500">{{ $post->created_at->format('Y-m-d') }}</small>
						</a>
					</li>
				@empty
					<li class="text-gray-500 italic">まだ投稿がありません。</li>
				@endforelse
			</ul>
		</section>

	</div>
</x-app-layout>