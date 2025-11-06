<x-app-layout>
	<x-slot name="header">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
					{{ __('Edit') }}
			</h2>
	</x-slot>
	
	<div class="edit-form">
		<form method="POST" action="{{ route('posts.update', $post->id) }}">
			@csrf
			@method('PUT')

			<label for="title">タイトル</label><br>
			<input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required><br><br>

			<label for="content">本文</label><br>
			<textarea name="content" id="content" rows="5" required>{{ old('content', $post->content) }}</textarea><br><br>

			<button type="submit">更新する</button>
		</form>
	</div>

</x-app-layout>