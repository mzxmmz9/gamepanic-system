<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			投稿詳細
		</h2>
	</x-slot>

	<h2>確認画面</h2>
	<p>{{ $content }}</p>

	@if (!empty($temp_images))
		<div class="flex gap-4">
			@foreach ($temp_images as $img)
				<img src="{{ asset('storage/' . $img) }}" class="w-32 h-32 object-cover">
			@endforeach
		</div>
	@endif

	<!-- 入力画面に戻る -->
	<form method="POST" action="{{ route('answers.back') }}">
		@csrf
		<input type="hidden" name="post_id" value="{{ $post->id }}">
		<input type="hidden" name="content" value="{{ $content }}">

		@if (!empty($temp_images))
			@foreach ($temp_images as $img)
				<input type="hidden" name="temp_images[]" value="{{ $img }}">
			@endforeach
		@endif

		<button type="submit">入力画面に戻る</button>
	</form>

	<!-- 投稿する -->
	<form method="POST" action="{{ route('answers.store') }}">
		@csrf
		<input type="hidden" name="post_id" value="{{ $post->id }}">
		<input type="hidden" name="content" value="{{ $content }}">

		@if (!empty($temp_images))
			@foreach ($temp_images as $img)
				<input type="hidden" name="temp_images[]" value="{{ $img }}">
			@endforeach
		@endif

		<button type="submit">投稿する</button>
	</form>

</x-app-layout>