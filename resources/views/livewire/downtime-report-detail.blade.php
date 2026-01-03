<div id="machine-downtime-detail" class="mt-6">
	<div class="bg-white shadow-sm border rounded-lg p-6">

		@if (!empty($selectedDowntime))
			{{-- 選択中の休止情報 --}}
			<h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">
				選択中の休止情報
			</h3>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-sm text-gray-700">
				<div>
					<span class="font-semibold">資産番号：</span>
					{{ $selectedDowntime['machine_code'] ?? '情報なし' }}
				</div>

				<div>
					<span class="font-semibold">停止開始：</span>
					{{ $selectedDowntime['downtime_start'] ?? '情報なし' }}
				</div>

				<div>
					<span class="font-semibold">停止終了：</span>
					{{ $selectedDowntime['downtime_end'] ?? '未入力' }}
				</div>

				<div class="md:col-span-2">
					<span class="font-semibold">理由：</span>
					{{ $selectedDowntime['reason'] ?? '情報なし' }}
				</div>
			</div>

			<hr class="my-6 border-t border-dashed border-gray-300">

			{{-- ボタン --}}
			<div x-data class="text-right">
				<x-button
					wire:click="$dispatch('downtimeForm-updateRef', { reportJson: {{ json_encode($selectedDowntime) }} })"
					wire:key="{{ $selectedDowntime['id'] }}"
					label="この休止情報を編集する"
					variant="secondary"
					x-on:click="document.getElementById('report-form')?.scrollIntoView({ behavior: 'smooth' })"
				/>
			</div>

		@else
			<p class="text-gray-500">報告書が選択されていません。</p>
		@endif

	</div>
</div>