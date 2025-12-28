<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-slate-800 leading-tight tracking-tight">
			{{ __('Create') }}
		</h2>
	</x-slot>
	<div class="max-w-4xl min-w-max mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8">

        <h2>確認画面</h2>
        <p>タイトル：{{ $title }}</p>
        <p>本文：{{ $content }}</p>

        <div class="flex gap-4 mt-4">
            @foreach ($temp_images as $img)
                <img src="{{ asset('storage/' . $img) }}" 
                    class="w-32 h-32 object-cover rounded border">
            @endforeach
        </div>

        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <input type="hidden" name="title" value="{{ $title }}">
            <input type="hidden" name="content" value="{{ $content }}">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
                この内容で投稿する
            </button>
        </form>

    </div>
</x-app-layout>