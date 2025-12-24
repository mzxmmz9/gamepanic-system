<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            店舗別マシン集計一覧
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- 店舗選択フォーム -->
        <div class="mb-6 bg-white shadow rounded-lg p-4">
            <form method="GET" action="{{ route('machine_aggregators.index') }}" class="flex items-center gap-4">
                <label for="branch_id" class="font-medium text-gray-700">店舗選択</label>

                <select
                    name="branch_id"
                    id="branch_id"
                    onchange="this.form.submit()"
                    class="select select-bordered w-60"
                >
                    <option value="">全店舗</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ $branchId == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- テーブル -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="table table-zebra w-full">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="font-semibold">店舗</th>
                        <th class="font-semibold">マシン</th>
                        <th class="font-semibold">休止開始時間</th>
                        <th class="font-semibold">休止終了時間</th>
                        <th class="font-semibold">休止時間 (h)</th>
                        <th class="font-semibold">損失額 (円)</th>
                    </tr>
                </thead>

                <tbody class="text-sm">
                    @foreach($machines as $machine)
                        <tr class="hover:bg-gray-50">
                            <td>{{ $machine->branch_name }}</td>
                            <td>{{ $machine->machine_name }}</td>
                            <td>{{ $machine->downtime_start }}</td>
                            <td>{{ $machine->downtime_end }}</td>
                            <td>{{ $machine->downtime_diff ?? '-' }}</td>
                            <td>{{ number_format($machine->loss_amount) }} 円</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ページネーション -->
        <div class="mt-6">
            {{ $machines->appends(['branch_id' => $branchId])->links() }}
        </div>

    </div>
</x-app-layout>