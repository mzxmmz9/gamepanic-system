<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">
            {{ __('休止情報の確認') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded">
        @php
            // コントローラで session(['report_data' => $validated]) を入れておく想定
            $data = session('report_data');
        @endphp

        @if ($data)
            <div class="space-y-4">
                <div>
                    <dt class="font-semibold text-gray-700">マシンコード</dt>
                    <dd class="text-gray-900">{{ $data['machine_code'] ?? '情報なし' }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-700">休止開始日時</dt>
                    <dd class="text-gray-900">{{ $data['downtime_start'] ?? '未入力' }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-700">休止終了日時</dt>
                    <dd class="text-gray-900">{{ $data['downtime_end'] ?? '未入力' }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-700">休止理由</dt>
                    <dd class="text-gray-900">{{ $data['reason'] ?? '未入力' }}</dd>
                </div>
            </div>

            <div class="mt-8 flex justify-between">
                <!-- 戻るボタン -->
                <a href="{{ route('machine_downtimes.create') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                    戻る
                </a>

                <!-- 確定送信ボタン -->
                <form action="{{ route('machine_downtimes.store') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        この内容で登録する
                    </button>
                </form>
            </div>
        @else
            <p class="text-red-600">確認データが見つかりませんでした。</p>
            <a href="{{ route('machine_downtimes.create') }}" class="text-blue-500 underline">フォームに戻る</a>
        @endif
    </div>
</x-app-layout>