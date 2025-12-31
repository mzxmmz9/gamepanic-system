<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">報告書選択</h2>
	</x-slot>

	<div class="
		max-w-4xl min-w-max 
		w-[100%] sm:w-[100%] md:w-[70%] lg:w-[60%] xl:w-[50%]
		 mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8
	">
		<p>稼働日を入力する報告書を選択してください</p>
		<form method="GET" action="{{ route('failure_reports.index') }}">
			<label>店舗</label>
			<select name="branch_id" onchange="this.form.submit()">
				<option value="">全店舗</option>
				@foreach($branches as $branch)
					<option value="{{ $branch->id }}" 
						{{ $selectedBranch == $branch->id ? 'selected' : '' }}>
						{{ $branch->name }}
					</option>
				@endforeach
			</select>
		</form>

		<div class="max-h-80 overflow-y-auto p-4 border rounded bg-white shadow">
			@if(count($reports) > 0)
				<ul>
					@foreach($reports as $report)
					<li 
						onclick="window.dispatchEvent(new CustomEvent('reportDetail-ShowReport', { detail: { reportJson: @js($report) } }))"
						class="p-2 odd:bg-gray-100 even:bg-white"
						style="cursor:pointer;"
					>
						<span>{{ $report->branch_name }}</span>
						<span>{{ $report->machine_code }}</span>
						<span>{{ $report->machine_name }}</span>
						<span>ST:{{ $report->st_num }}</span>
					</li>
					@endforeach
				</ul>
			@else
				<p class="text-gray-500">該当する故障発生書はありません。</p>
			@endif
		</div>
		<livewire:failure-report-detail />
		<livewire:failure-report-form-update :reportJson="$reportJson ?? ''"/>
	</div>


</x-app-layout>