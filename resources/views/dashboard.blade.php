<x-app-layout>
	<x-slot name="header">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
					{{ __('Dashboard') }}
			</h2>
	</x-slot>

	<div class="dashboard">
		<section class="actions">
			<a href="{{ route('posts.create') }}" class="button">+ 新しい投稿</a>
		</section>

		<section class="latest-posts">
			<h2>直近の投稿</h2>
			<ul>
				@forelse ($latestPosts as $post)
					<li class="post">
						<a href="{{ route('posts.show', $post->id) }}">
							<strong>{{ $post->title }}</strong><br>
							<small>{{ $post->created_at->format('Y-m-d') }}</small>
						</a>
					</li>
				@empty
					<li>まだ投稿がありません。</li>
				@endforelse
			</ul>
		</section>

		<section class="store-activity">
			<h2>自店舗のアクティビティ</h2>

		</section>
	</div>

</x-app-layout>
