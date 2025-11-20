<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
    </x-slot>
		<livewire:machine-selector />
		<livewire:failure-report-machine-detail :showMachineCode="$machineCode ?? '' "/>

        <form method="POST" action="{{ route('machine_downtimes.store') }}" class="space-y-4">
            <div>
                <label for="machine_code" class="block font-medium mb-1">マシンコード</label>
                {{ $machine_code ?? '情報なし' }}
            </div>

            <div>
                <label for="downtime_start" class="block font-medium mb-1">休止開始日時</label>
                <input type="datetime-local" name="downtime_start" id="downtime_start" class="input input-bordered w-full" required>
            </div>

            <div>
                <label for="downtime_end" class="block font-medium mb-1">休止終了日時（任意）</label>
                <input type="datetime-local" name="downtime_end" id="downtime_end" class="input input-bordered w-full">
            </div>

            <div>
                <label for="reason" class="block font-medium mb-1">休止理由</label>
                <textarea name="reason" id="reason" rows="3" class="textarea textarea-bordered w-full"></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">登録する</button>
            </div>
        </form>
    </div>
</x-app-layout>