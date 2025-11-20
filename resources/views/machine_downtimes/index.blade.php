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
                        <th>機械コード</th>
                        <th>開始日時</th>
                        <th>終了日時</th>
                        <th>休止理由</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($downtimeMachines as $downtime)
                        <tr>
                            <td>{{ $downtime->machine_code }}</td>
                            <td>{{ $downtime->downtime_start }}</td>
                            <td>{{ $downtime->downtime_end ?? '稼働中' }}</td>
                            <td>{{ $downtime->reason }}</td>
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