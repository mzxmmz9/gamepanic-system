<div>
    <form action="{{ route('machine_downtimes.confirm') }}" method="POST" wire:key="{{ $machine_code }}" class="space-y-4" id="report-form">
        @csrf

        <div>
            <label for="machine_code" class="block font-medium mb-1">マシンコード</label>
            {{ $machine_code ?? '情報なし' }}
            <!-- hiddenで値を渡す -->
            <input type="hidden" name="machine_code" wire:model="machine_code">
        </div>

        <div>
            <label for="downtime_start" class="block font-medium mb-1">休止開始日時</label>
            <input type="datetime-local"
                   id="downtime_start"
                   name="downtime_start"
                   class="input input-bordered w-full"
                   wire:model="downtime_start"
                   required>
            @error('downtime_start') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="downtime_end" class="block font-medium mb-1">休止終了日時（任意）</label>
            <input type="datetime-local"
                   id="downtime_end"
                   name="downtime_end"
                   class="input input-bordered w-full"
                   wire:model="downtime_end">
            @error('downtime_end') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="reason" class="block font-medium mb-1">休止理由</label>
            <textarea id="reason"
                      name="reason"
                      rows="3"
                      class="textarea textarea-bordered w-full"
                      wire:model="reason"></textarea>
            @error('reason') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="btn btn-primary">確認へ進む</button>
        </div>
    </form>
</div>