<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
    </x-slot>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">機械休止リスト</h1>

        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>店舗</th>
                        <th>マシンコード</th>
                        <th>マシン名</th>
                        <th>休止開始日時</th>
                        <th>休止終了日時</th>
                        <th>休止理由</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $report)
                        <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->branch_name }}</td>
                            <td>{{ $report->machine_code }}</td>
                            <td>{{ $report->machine_name }}</td>
                            <td>{{ $report->downtime_start }}</td>
                            <td>{{ $report->downtime_end ?? '未設定' }}</td>
                            <td>{{ $report->reason }}</td>
                            <td>
                                <a href="{{ route('machine_downtimes.edit', $report->id) }}"
                                    class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition"
                                >
                                    編集
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">休止データがありません</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>