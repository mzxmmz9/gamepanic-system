<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            報告種別の選択
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- 店舗選択フォーム -->
        <div class="mb-6 bg-white shadow rounded-lg p-4">
            <form method="GET" action="{{ route('machine_downtimes.index') }}" class="flex items-center gap-4">
                <label for="branch_id" class="font-medium text-gray-700">店舗選択</label>

                <select
                    name="branch_id"
                    id="branch_id"
                    onchange="this.form.submit()"
                    class="select select-bordered w-60"
                >
                    <option value="">全店舗</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 border-b pb-2">
                機械休止リスト
            </h1>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="table table-zebra w-full">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="font-semibold">ID</th>
                        <th class="font-semibold">店舗</th>
                        <th class="font-semibold">マシンコード</th>
                        <th class="font-semibold">マシン名</th>
                        <th class="font-semibold">休止開始日時</th>
                        <th class="font-semibold">休止終了日時</th>
                        <th class="font-semibold">休止理由</th>
                        <th class="font-semibold text-center">操作</th>
                    </tr>
                </thead>

                <tbody class="text-sm">
                    @forelse ($records as $report)
                        <tr class="hover:bg-gray-50">
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->branch_name }}</td>
                            <td>{{ $report->machine_code }}</td>
                            <td>{{ $report->machine_name }}</td>
                            <td>{{ $report->downtime_start }}</td>
                            <td>{{ $report->downtime_end ?? '未設定' }}</td>
                            <td>{{ $report->reason }}</td>
                            <td class="text-center">
                                <a href="{{ route('machine_downtimes.edit', $report->id) }}"
                                   class="btn btn-sm btn-warning text-white">
                                    編集
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-6 text-gray-500">
                                休止データがありません
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>