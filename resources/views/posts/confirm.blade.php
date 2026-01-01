<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-slate-800 leading-tight tracking-tight">
			{{ __('Create') }}
		</h2>
	</x-slot>

	<div class="max-w-3xl mx-auto bg-white p-6 mt-8 rounded-lg shadow border space-y-6">

		<!-- 見出し -->
		<h2 class="text-lg font-semibold text-gray-700 border-b pb-2">
			確認画面
		</h2>

		<!-- 内容 -->
		<div class="space-y-2 text-gray-800 leading-relaxed">
			<p><span class="font-semibold text-gray-700">タイトル：</span>{{ $title }}</p>
			<p><span class="font-semibold text-gray-700">本文：</span>{{ $content }}</p>
		</div>

		<!-- 画像一覧 -->
		@if (!empty($temp_images))
			<div class="flex flex-wrap gap-4 pt-2">
				@foreach ($temp_images as $img)
					<img src="{{ asset('storage/' . $img) }}"
						 class="w-32 h-32 object-cover rounded border">
				@endforeach
			</div>
		@endif

		<!-- ボタンエリア -->
		<div class="pt-6 border-t flex flex-col sm:flex-row gap-3">

			<!-- 戻るボタン -->
			<form method="POST" action="{{ route('posts.back') }}" class="w-full">
				@csrf
				<input type="hidden" name="title" value="{{ $title }}">
				<input type="hidden" name="content" value="{{ $content }}">

				@foreach ($temp_images as $img)
					<input type="hidden" name="temp_images[]" value="{{ $img }}">
				@endforeach

				<button type="submit"
						class="w-full px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
					入力画面に戻る
				</button>
			</form>

			<!-- 投稿ボタン -->
			<form method="POST" action="{{ route('posts.store') }}" class="w-full">
				@csrf
				<input type="hidden" name="title" value="{{ $title }}">
				<input type="hidden" name="content" value="{{ $content }}">
				@foreach ($temp_images as $img)
					<input type="hidden" name="temp_images[]" value="{{ $img }}">
				@endforeach

				<button type="submit"
						class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
					この内容で投稿する
				</button>
			</form>

		</div>

	</div>
</x-app-layout>