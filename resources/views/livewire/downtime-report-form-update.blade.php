<div id="downtime-form" class="mt-10 bg-white p-6 rounded-lg shadow border">

    <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">
        休止情報の編集
    </h3>

    @if (session('success'))
        <p class="text-green-600 font-semibold mb-3">{{ session('success') }}</p>
    @endif

    <form wire:submit.prevent="update" wire:key="{{ $machine_code }}" class="space-y-5">

        {{-- 資産番号（編集不可） --}}
        <div class="flex flex-col">
            <label class="font-semibold text-gray-700 mb-1">資産番号</label>
            <input 
                type="text"
                class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                wire:model="machine_code"
                readonly
            >
        </div>

        {{-- 停止開始（編集不可） --}}
        <div class="flex flex-col">
            <label class="font-semibold text-gray-700 mb-1">停止開始</label>
            <input 
                type="datetime-local"
                class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                wire:model="downtime_start"
                readonly
            >
        </div>

        {{-- 停止終了（編集可能） --}}
        <div class="flex flex-col">
            <label class="font-semibold text-gray-700 mb-1">停止終了</label>
            <input 
                type="datetime-local"
                class="input input-bordered"
                wire:model="downtime_end"
            >
        </div>

        {{-- 理由（編集可能） --}}
        <div class="flex flex-col">
            <label class="font-semibold text-gray-700 mb-1">理由</label>
            <textarea 
                class="textarea textarea-bordered"
                wire:model="reason"
            ></textarea>
        </div>

        <x-button type="submit" label="更新する" variant="primary" />
    </form>
</div>