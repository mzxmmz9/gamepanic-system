<div>
	<div class="report-detail bg-gray-100 p-4 rounded mt-4">
		@if(!empty($selectedReport))
			{{-- 選択マシン情報 --}}
			<p><strong>発生日：</strong>{{ $selectedReport['occurred_at'] ?? '情報なし' }}</p>
			<p><strong>発生日担当者：</strong>{{ $selectedReport['occurred_by'] ?? '情報なし' }}</p>
			<p><strong>対応：</strong>{{ $selectedReport['process'] ?? '情報なし' }}</p>
			<p><strong>資産番号：</strong>{{ $selectedReport['machine_code'] ?? '情報なし' }}</p>
			<p><strong>マシン名：</strong>{{ $selectedReport['machine_name'] ?? '情報なし' }}</p>
			<p><strong>ST番号：</strong>{{ $selectedReport['st_num'] ?? '情報なし' }}</p>
			<p><strong>故障内容：</strong>{{ $selectedReport['malfunction'] ?? '情報なし' }}</p>
			<p><strong>稼働日：</strong>{{ $selectedReport['resumed_at'] ?? '情報なし' }}</p>
			<p><strong>稼働日担当者：</strong>{{ $selectedReport['resumed_by'] ?? '情報なし' }}</p>
			<p><strong>備考：</strong>{{ $selectedReport['note'] ?? '情報なし' }}</p>
			{{--
			<p><strong>休止理由・機械状態①：</strong>{{ $selectedReport[''] }}</p>
			<p><strong>休止理由・機械状態②：</strong>{{ $selectedReport[''] }}</p>
			<p><strong>休止理由・機械状態③：</strong>{{ $selectedReport[''] }}</p>
			<p><strong>休止理由・機械状態④：</strong>{{ $selectedReport[''] }}</p>
			<p><strong>休止理由・機械状態⑤：</strong>{{ $selectedReport[''] }}</p>
			--}}
			{{-- 選択マシン情報end --}}
			<hr class="my-4 border-t border-dashed border-gray-400">
			<x-button
				wire:click="$dispatch( 'reportForm-updateRef', { reportJson: {{ json_encode($selectedReport) }} } )"
				wire:key="{{ $selectedReport['id'] }}" 
				label="この報告書に稼働日を登録する"
				variant="secondary"
			/>
		@else
			<p class="text-gray-500">報告書が選択されていません。</p>
		@endif
	</div>

	{{--

--}}
</div>
