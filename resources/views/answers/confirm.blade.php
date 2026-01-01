<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			投稿詳細
		</h2>
	</x-slot>

	<div class="max-w-3xl mx-auto bg-white p-6 mt-6 rounded-lg shadow border space-y-6">

		<!-- タイトル -->
		<h2 class="text-lg font-semibold text-gray-700 border-b pb-2">
			確認画面
		</h2>

		<!-- 内容 -->
		<div class="text-gray-800 leading-relaxed whitespace-pre-line">
			{{ $content }}
		</div>

		<!-- 画像一覧 -->
		@if (!empty($temp_images))
			<div class="flex flex-wrap gap-4">
				@foreach ($temp_images as $img)
					<img src="{{ asset('storage/' . $img) }}"
						 class="w-32 h-32 object-cover rounded border">
				@endforeach
			</div>
		@endif

		<!-- 注意文言 -->
		<p class="text-sm text-gray-600 bg-gray-50 border border-gray-200 p-3 rounded">
			投稿後の編集、削除はできません。
		</p>

		<!-- ボタンエリア -->
		<div class="flex flex-col sm:flex-row gap-3 pt-4 border-t">

			<!-- 入力画面に戻る -->
			<form method="POST" action="{{ route('answers.back') }}" class="flex-1">
				@csrf
				<input type="hidden" name="post_id" value="{{ $post->id }}">
				<input type="hidden" name="content" value="{{ $content }}">

				@if (!empty($temp_images))
					@foreach ($temp_images as $img)
						<input type="hidden" name="temp_images[]" value="{{ $img }}">
					@endforeach
				@endif

				<button type="submit"
						class="w-full px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
					入力画面に戻る
				</button>
			</form>

			<!-- 投稿する -->
			<form method="POST" action="{{ route('answers.store') }}" class="flex-1">
				@csrf
				<input type="hidden" name="post_id" value="{{ $post->id }}">
				<input type="hidden" name="content" value="{{ $content }}">

				@if (!empty($temp_images))
					@foreach ($temp_images as $img)
						<input type="hidden" name="temp_images[]" value="{{ $img }}">
					@endforeach
				@endif

				<button type="submit"
						class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
					投稿する
				</button>
			</form>

		</div>

	</div>
</x-app-layout>