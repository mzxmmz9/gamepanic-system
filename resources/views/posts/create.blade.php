<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight tracking-tight">
            {{ __('Create') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md space-y-6">
        <h2 class="text-2xl font-bold text-slate-700 flex items-center gap-2">
        	<span>新しい投稿</span>
        </h2>

        <form method="POST" action="{{ route('posts.store') }}" class="space-y-6">
            @csrf

            <!-- タイトル -->
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 mb-1">タイトル</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title') }}"
                       required
                       class="w-full border border-slate-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <!-- 本文 -->
            <div>
                <label for="content" class="block text-sm font-medium text-slate-700 mb-1">本文</label>
                <textarea name="content" id="content" rows="6" required
                          class="w-full border border-slate-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-y">{{ old('content') }}</textarea>
            </div>

            <!-- 送信ボタン -->
            <div class="text-right">
                <button type="submit"
                        class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2 rounded-md shadow-sm transition">
                	投稿する
                </button>
            </div>
        </form>
    </div>
</x-app-layout>