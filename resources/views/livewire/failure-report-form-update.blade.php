<div>
    <div class="mx-auto p-6 bg-white rounded-lg shadow-md">
        <form wire:submit.prevent="submit" wire:key="{{ $machine_code }}" class="space-y-5">

            {{-- 発生日（編集不可） --}}
            <div class="flex items-center">
                <label class="inline-block w-28 font-semibold text-gray-700">発生日</label>
                <input 
                    type="date"
                    wire:model="occurred_at"
                    max="{{ now()->format('Y-m-d') }}"
                    class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                    readonly
                >
            </div>

            {{-- 発生日担当者（編集不可） --}}
            <div class="flex items-center">
                <label class="inline-block w-28 font-semibold text-gray-700">発生日担当者</label>
                <input 
                    type="text"
                    wire:model="occurred_by"
                    class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                    readonly
                >
            </div>

            {{-- 対応（編集可能） --}}
            <div class="flex items-center">
                <label class="inline-block w-28 font-semibold text-gray-700">対応</label>
                <select wire:model="process" class="select select-bordered w-full max-w-xs">
                    <option value="">選択してください</option>
                    <option value="店舗処理">店舗処理</option>
                    <option value="メンテナンス相談">メンテナンス相談</option>
                </select>
            </div>

            {{-- 資産番号（編集不可） --}}
            <div class="flex items-center">
                <label class="inline-block w-28 font-semibold text-gray-700">資産番号</label>
                <input 
                    type="text"
                    wire:model="machine_code"
                    class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                    readonly
                >
            </div>

            {{-- マシン名（編集不可） --}}
            <div class="flex items-center">
                <label class="inline-block w-28 font-semibold text-gray-700">マシン名</label>
                <input 
                    type="text"
                    wire:model="machine_name"
                    class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                    readonly
                >
            </div>

            {{-- ST番号（編集不可） --}}
            <div class="flex items-center">
                <label class="inline-block w-28 font-semibold text-gray-700">ST番号</label>
                <input 
                    type="text"
                    wire:model="st_num"
                    class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                    readonly
                >
            </div>

            {{-- 故障内容（編集不可） --}}
            <div class="flex items-start">
                <label class="inline-block w-28 font-semibold text-gray-700">故障内容</label>
                <textarea 
                    wire:model="malfunction"
                    class="textarea textarea-bordered bg-gray-100 text-gray-600 cursor-not-allowed w-full"
                    readonly
                ></textarea>
            </div>

            {{-- 稼働日（編集可能） --}}
            <div class="flex items-center">
                <label class="inline-block w-28 font-semibold text-gray-700">稼働日</label>
                <input 
                    type="date"
                    wire:model="resumed_at"
                    max="{{ now()->format('Y-m-d') }}"
                    class="input input-bordered"
                >
            </div>

            {{-- 稼働日担当者（編集可能） --}}
            <div class="flex items-center">
                <label class="inline-block w-28 font-semibold text-gray-700">稼働日担当者</label>
                <input 
                    type="text"
                    wire:model="resumed_by"
                    class="input input-bordered"
                >
            </div>

            {{-- 備考（編集可能） --}}
            <div class="flex items-start">
                <label class="inline-block w-28 font-semibold text-gray-700">備考</label>
                <textarea 
                    wire:model="note"
                    class="textarea textarea-bordered w-full"
                ></textarea>
            </div>

            <button type="submit" class="btn btn-primary">送信</button>

        </form>
    </div>

    @if(session()->has('message'))
        <p class="text-green-600 mt-3">{{ session('message') }}</p>
    @endif
</div>