<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-slate-800 leading-tight tracking-tight">
			{{ __('Edit') }}
		</h2>
	</x-slot>

	<div class="max-w-4xl min-w-max mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8">
		<h2 class="text-2xl font-bold text-slate-700">投稿を編集</h2>

		<form method="POST" action="{{ route('posts.update', $post->id) }}" class="space-y-6">
			@csrf
			@method('PUT')

			<!-- タイトル -->
			<div>
				<label for="title" class="block text-sm font-medium text-slate-700 mb-1">タイトル</label>
				<input type="text" name="title" id="title"
					   value="{{ old('title', $post->title) }}"
					   required
					   class="w-full border border-slate-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
			</div>

			<!-- 本文 -->
			<div>
				<label for="content" class="block text-sm font-medium text-slate-700 mb-1">本文</label>
				<textarea name="content" id="content" rows="6" required
						  class="w-full border border-slate-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-y">{{ old('content', $post->content) }}</textarea>
			</div>

			<!-- 更新ボタン -->
			<div class="text-right">
				<button type="submit"
						class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2 rounded-md shadow-sm transition">
					この内容で更新する
				</button>
			</div>
		</form>
	</div>
</x-app-layout>