<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">
		{{ __('マシン稼働状況更新') }}
		</h2>
	</x-slot>

<div class="mx-auto p-6 bg-white rounded-lg shadow-md">
    <form method="POST" action="{{ route('failure_reports.confirm-update') }}" class="space-y-5">
        @csrf

        {{-- 発生日（編集不可） --}}
        <div class="flex items-center">
            <label class="inline-block w-28 font-semibold text-gray-700">発生日</label>
            <input 
                type="date"
                name="occurred_at"
                value="{{ $report['occurred_at'] }}"
                class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                readonly
            >
        </div>

        {{-- 発生日担当者（編集不可） --}}
        <div class="flex items-center">
            <label class="inline-block w-28 font-semibold text-gray-700">発生日担当者</label>
            <input 
                type="text"
                name="occurred_by"
                value="{{ $report['occurred_by'] }}"
                class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                readonly
            >
        </div>

        {{-- 対応（編集可能） --}}
        <div class="flex items-center">
            <label class="inline-block w-28 font-semibold text-gray-700">対応</label>
            <select name="process" class="select select-bordered w-full max-w-xs">
                <option value="">選択してください</option>
                <option value="店舗処理" {{ $report['process'] === '店舗処理' ? 'selected' : '' }}>店舗処理</option>
                <option value="メンテナンス相談" {{ $report['process'] === 'メンテナンス相談' ? 'selected' : '' }}>メンテナンス相談</option>
            </select>
        </div>

        {{-- 資産番号（編集不可） --}}
        <div class="flex items-center">
            <label class="inline-block w-28 font-semibold text-gray-700">資産番号</label>
            <input 
                type="text"
                name="machine_code"
                value="{{ $report['machine_code'] }}"
                class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                readonly
            >
        </div>

        {{-- マシン名（編集不可） --}}
        <div class="flex items-center">
            <label class="inline-block w-28 font-semibold text-gray-700">マシン名</label>
            <input 
                type="text"
                name="machine_name"
                value="{{ $report['machine_name'] }}"
                class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                readonly
            >
        </div>

        {{-- ST番号（編集不可） --}}
        <div class="flex items-center">
            <label class="inline-block w-28 font-semibold text-gray-700">ST番号</label>
            <input 
                type="text"
                name="st_num"
                value="{{ $report['st_num'] }}"
                class="input input-bordered bg-gray-100 text-gray-600 cursor-not-allowed"
                readonly
            >
        </div>

        {{-- 故障内容（編集不可） --}}
        <div class="flex items-start">
            <label class="inline-block w-28 font-semibold text-gray-700">故障内容</label>
            <textarea 
                name="malfunction"
                class="textarea textarea-bordered bg-gray-100 text-gray-600 cursor-not-allowed w-full"
                readonly
            >{{ $report['malfunction'] }}</textarea>
        </div>

        {{-- 稼働日（編集可能） --}}
        <div class="flex items-center">
            <label class="inline-block w-28 font-semibold text-gray-700">稼働日</label>
            <input 
                type="date"
                name="resumed_at"
                value="{{ $report['resumed_at'] }}"
                max="{{ now()->format('Y-m-d') }}"
                class="input input-bordered"
            >
        </div>

        {{-- 稼働日担当者（編集可能） --}}
        <div class="flex items-center">
            <label class="inline-block w-28 font-semibold text-gray-700">稼働日担当者</label>
            <input 
                type="text"
                name="resumed_by"
                value="{{ $report['resumed_by'] }}"
                class="input input-bordered"
            >
        </div>

        {{-- 備考（編集可能） --}}
        <div class="flex items-start">
            <label class="inline-block w-28 font-semibold text-gray-700">備考</label>
            <textarea 
                name="note"
                class="textarea textarea-bordered w-full"
            >{{ $report['note'] }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">送信</button>
    </form>
</div>

</x-app-layout>