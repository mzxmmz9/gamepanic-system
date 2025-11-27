<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
    </x-slot>
    <div class="space-y-4">
        <h2 class="text-lg font-bold">入力内容の確認</h2>

        <p>マシンコード: {{ $report_data['machine_code'] }}</p>
        <p>休止開始日時: {{ $report_data['downtime_start'] }}</p>
        <p>休止終了日時: {{ $report_data['downtime_end'] ?? '未入力' }}</p>
        <p>休止理由: {{ $report_data['reason'] ?? '未入力' }}</p>

        <form action="{{ route('machine_downtimes.store') }}" method="POST">
            <input type="hidden" name="machine_code" value="{{ $report_data['machine_code'] }}">
            <input type="hidden" name="downtime_start" value="{{ $report_data['downtime_start'] }}">
            <input type="hidden" name="downtime_end" value="{{ $report_data['downtime_end'] }}">
            <input type="hidden" name="reason" value="{{ $report_data['reason'] }}">

            <div class="flex justify-end space-x-2">
                <button type="submit" class="btn btn-primary">登録する</button>
                <a href="{{ route('machine_downtimes.create') }}" class="btn">戻る</a>
            </div>
        </form>
    </div>
</x-app-layout>