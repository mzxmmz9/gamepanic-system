<x-app-layout>
	<x-slot name="header">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
					{{ __('Create') }}
			</h2>
	</x-slot>

<h2>🆕 新しい投稿</h2>

<form method="POST" action="{{ route('posts.store') }}">
	@csrf

	<label for="title">タイトル</label><br>
	<input type="text" name="title" id="title" value="{{ old('title') }}" required><br><br>

	<label for="content">本文</label><br>
	<textarea name="content" id="content" rows="5" required>{{ old('content') }}</textarea><br><br>

	<button type="submit">投稿する</button>
</form>

</x-app-layout>