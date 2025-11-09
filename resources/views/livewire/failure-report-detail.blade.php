<div id="machine-detail" class="mt-6">
	<div class="bg-white shadow-sm border rounded-lg p-6">
		@if (!empty($selectedReport))
			{{-- 選択マシン情報 --}}
			<h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">選択中の報告書情報</h3>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-sm text-gray-700">
				<div><span class="font-semibold">発生日：</span>{{ $selectedReport['occurred_at'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">発生日担当者：</span>{{ $selectedReport['occurred_by'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">対応：</span>{{ $selectedReport['process'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">資産番号：</span>{{ $selectedReport['machine_code'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">マシン名：</span>{{ $selectedReport['machine_name'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">ST番号：</span>{{ $selectedReport['st_num'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">故障内容：</span>{{ $selectedReport['malfunction'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">稼働日：</span>{{ $selectedReport['resumed_at'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">稼働日担当者：</span>{{ $selectedReport['resumed_by'] ?? '情報なし' }}</div>
				<div class="md:col-span-2"><span class="font-semibold">備考：</span>{{ $selectedReport['note'] ?? '情報なし' }}</div>

				{{-- 
				<div><span class="font-semibold">休止理由・機械状態①：</span>{{ $selectedReport[''] }}</div>
				<div><span class="font-semibold">休止理由・機械状態②：</span>{{ $selectedReport[''] }}</div>
				<div><span class="font-semibold">休止理由・機械状態③：</span>{{ $selectedReport[''] }}</div>
				<div><span class="font-semibold">休止理由・機械状態④：</span>{{ $selectedReport[''] }}</div>
				<div><span class="font-semibold">休止理由・機械状態⑤：</span>{{ $selectedReport[''] }}</div>
				--}}
			</div>

			{{-- 選択マシン情報end --}}
			<hr class="my-6 border-t border-dashed border-gray-300">

			<div x-data class="text-right">
				<x-button
					wire:click="$dispatch('reportForm-updateRef', { reportJson: {{ json_encode($selectedReport) }} })"
					wire:key="{{ $selectedReport['id'] }}"
					label="この報告書に稼働日を登録する"
					variant="secondary"
					x-on:click="document.getElementById('report-form')?.scrollIntoView({ behavior: 'smooth' })"
				/>
			</div>
		@else
			<p class="text-gray-500">報告書が選択されていません。</p>
		@endif
	</div>

	{{-- 
		ここに他の要素が入る可能性あり
	--}}
</div>