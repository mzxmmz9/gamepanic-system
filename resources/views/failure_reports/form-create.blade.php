<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">
		{{ __('マシン稼働状況更新') }}
		</h2>
	</x-slot>

<div>
    <form action="{{ route('failure_reports.confirm') }}" method="POST" class="space-y-4" id="report-form">
        @csrf

        <div>
            <label class="inline-block w-24 mr-4">発生日</label>
            <input type="date"
                name="occurred_at"
                max="{{ now()->format('Y-m-d') }}"
                value="{{ old('occurred_at') }}">
        </div>

        <div>
            <label class="inline-block w-24 mr-4">発生日担当者</label>
            <input type="text"
                name="occurred_by"
                value="{{ old('occurred_by') }}"
                placeholder="発生日担当者">
        </div>

        <div>
            <label class="inline-block w-24 mr-4">対応</label>
            <select name="process">
                <option value="">選択してください</option>
                <option value="店舗処理" {{ old('process') === '店舗処理' ? 'selected' : '' }}>店舗処理</option>
                <option value="メンテナンス相談" {{ old('process') === 'メンテナンス相談' ? 'selected' : '' }}>メンテナンス相談</option>
            </select>
        </div>

        <div>
            <label class="inline-block w-24 mr-4">資産番号</label>
            <input type="text"
                name="machine_code"
                value="{{ $machine_code }}"
                readonly>
        </div>

        <div>
            <label class="inline-block w-24 mr-4">マシン名</label>
            <input type="text"
                name="machine_name"
                value="{{ $machine_name }}"
                readonly>
        </div>

        <div>
            <label class="inline-block w-24 mr-4">ST番号</label>
            <input type="text"
                name="st_num"
                value="{{ old('st_num', $st_num) }}"
                placeholder="ST番号">
        </div>

        <div>
            <label class="inline-block w-24 mr-4">故障内容</label>
            <textarea name="malfunction" placeholder="故障内容">{{ old('malfunction', $malfunction) }}</textarea>
        </div>

        <div>
            <label class="inline-block w-24 mr-4">備考</label>
            <textarea name="note" placeholder="備考">{{ old('note', $note) }}</textarea>
        </div>

        <input type="hidden" name="branch_id" value="{{ $branch_id }}">

        <button type="submit">内容を確認する</button>
    </form>
</div>

</x-app-layout>