<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			投稿詳細
		</h2>
	</x-slot>

	<h2>確認画面</h2>
	<p>{{ $content }}</p>

	@foreach ($pendingImages as $filename)
		<img src="{{ Storage::url('temp-images/' . $filename) }}" style="max-height:200px;">
	@endforeach

	<form method="POST" action="{{ route('answers.back') }}">
		@csrf
		<input type="hidden" name="post_id" value="{{ $post->id }}">
		<input type="hidden" name="content" value="{{ $content }}">
		<button type="submit">入力画面に戻る</button>
	</form>
	<form method="POST" action="{{ route('answers.store') }}">
		@csrf
		<input type="hidden" name="post_id" value="{{ $post->id }}">
		<input type="hidden" name="content" value="{{ $content }}">
		<button type="submit">投稿する</button>
	</form>

</x-app-layout>