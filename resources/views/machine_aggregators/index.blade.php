<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">店舗別マシン集計一覧</h2>
	</x-slot>
	<div class="
		max-w-4xl 
		mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8
	">

		<!-- 店舗選択フォーム -->
		<form method="GET" action="{{ route('machine_aggregators.index') }}" class="mb-4">
			<label for="branch_id" class="mr-2">店舗選択:</label>
			<select name="branch_id" id="branch_id" onchange="this.form.submit()" class="border rounded px-2 py-1">
				<option value="">全店舗</option>
				@foreach($branches as $branch)
					<option value="{{ $branch->id }}" {{ $branchId == $branch->id ? 'selected' : '' }}>
						{{ $branch->name }}
					</option>
				@endforeach
			</select>
		</form>

		<!-- テーブル -->
		<table class="table-auto border-collapse border w-full">
			<thead>
				<tr class="bg-gray-200">
					<th class="border px-4 py-2">店舗</th>
					<th class="border px-4 py-2">マシン</th>
					<th class="border px-4 py-2">休止開始時間</th>
					<th class="border px-4 py-2">休止終了時間</th>
					<th class="border px-4 py-2">休止時間 (h)</th>
					<th class="border px-4 py-2">損失額 (円)</th>
				</tr>
			</thead>
			<tbody>
				@foreach($machines as $machine)
					<tr>
						<td class="border px-4 py-2">{{ $machine->branch_name }}</td>
						<td class="border px-4 py-2">{{ $machine->machine_name }}</td>
						<td class="border px-4 py-2">{{ $machine->downtime_start }}</td>
						<td class="border px-4 py-2">{{ $machine->downtime_end }}</td>
						<td class="border px-4 py-2">{{ $machine->downtime_diff ?? '-' }}</td>
						<td class="border px-4 py-2">{{ number_format($machine->loss_amount) }} 円</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<!-- ページネーション -->
		<div class="mt-4">
			{{ $machines->appends(['branch_id' => $branchId])->links() }}
		</div>
	</div>
</x-app-layout>