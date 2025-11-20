<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
    </x-slot>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">休止情報の確認</h1>

        <form method="POST" action="{{ route('machine_downtime.store') }}">
            @csrf

            <div class="mb-4">
                <label class="font-medium">機械コード：</label>
                <div>{{ $data['machine_code'] }}</div>
                <input type="hidden" name="machine_code" value="{{ $data['machine_code'] }}">
            </div>

            <div class="mb-4">
                <label class="font-medium">開始日時：</label>
                <div>{{ $data['downtime_start'] }}</div>
                <input type="hidden" name="downtime_start" value="{{ $data['downtime_start'] }}">
            </div>

            <div class="mb-4">
                <label class="font-medium">終了日時：</label>
                <div>{{ $data['downtime_end'] ?? '未入力' }}</div>
                <input type="hidden" name="downtime_end" value="{{ $data['downtime_end'] }}">
            </div>

            <div class="mb-4">
                <label class="font-medium">理由：</label>
                <div>{{ $data['reason'] }}</div>
                <input type="hidden" name="reason" value="{{ $data['reason'] }}">
            </div>

            <div class="flex justify-between mt-6">
                <button type="button" onclick="history.back()" class="btn btn-outline">戻る</button>
                <button type="submit" class="btn btn-primary">登録する</button>
            </div>
        </form>
    </div>
</x-app-layout>