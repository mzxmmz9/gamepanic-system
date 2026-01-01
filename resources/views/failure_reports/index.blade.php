<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">
			{{ __('マシン稼働状況更新') }}
		</h2>
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

		<div class="max-h-80 overflow-y-auto p-4 border rounded bg-white">

			@if(count($reports) > 0)

				<table class="min-w-full text-sm text-left border-collapse">
					<thead class="bg-gray-200 text-gray-700 sticky top-0">
						<tr>
							<th class="px-3 py-2 border">店舗</th>
							<th class="px-3 py-2 border">機械コード</th>
							<th class="px-3 py-2 border">機械名</th>
							<th class="px-3 py-2 border">ST番号</th>
						</tr>
					</thead>

					<tbody>
						@foreach($reports as $report)
							<tr
								onclick="window.dispatchEvent(new CustomEvent('reportDetail-ShowReport', { detail: { reportJson: @js($report) } }))"
								class="cursor-pointer odd:bg-gray-100 even:bg-white hover:bg-indigo-100 transition"
							>
								<td class="px-3 py-2 border">{{ $report->branch_name }}</td>
								<td class="px-3 py-2 border">{{ $report->machine_code }}</td>
								<td class="px-3 py-2 border">{{ $report->machine_name }}</td>
								<td class="px-3 py-2 border">{{ $report->st_num }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			@else
				<p class="text-gray-500">該当する故障発生書はありません。</p>
			@endif

		</div>

		<livewire:failure-report-detail />
		<livewire:failure-report-form-update :reportJson="$reportJson ?? ''"/>
	</div>


</x-app-layout>