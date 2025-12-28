<div class="max-h-80 overflow-y-auto p-4 border rounded bg-white shadow">
	@if(count($reports) > 0)
		<ul>
			@foreach($reports as $report)
			<li 
				wire:click="$dispatch('reportDetail-ShowReport', { reportJson: {{ json_encode($report) }} })"
				wire:key="{{ $report->id }}" 
				class="p-2 odd:bg-gray-100 even:bg-white" 
				style="cursor:pointer;"
			>
				<span>{{ $report->branch_id }}</span>
				<span>{{ $report->machine_code }}</span>
				<span>{{ $report->machine_name }}</span>
				<span>ST:{{ $report->st_num }}</span>
			</li>
			@endforeach
		</ul>
	@else
		<p class="text-gray-500">稼働日が入力されていない故障発生書はありません。</p>
	@endif

</div>