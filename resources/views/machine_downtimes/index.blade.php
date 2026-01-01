<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
	</x-slot>

	<div class="
		max-w-4xl min-w-max
		w-[100%] sm:w-[100%] md:w-[70%] lg:w-[60%] xl:w-[50%]
		mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8
	">
		<h1 class="text-2xl font-bold mb-4 text-gray-700">機械休止リスト</h1>

		<div class="overflow-x-auto max-h-96 border rounded shadow bg-white">
			@if ($records->count() > 0)
				<table class="min-w-full text-sm text-left border-collapse">
					<thead class="bg-gray-200 text-gray-700 sticky top-0">
						<tr>
							<th class="px-3 py-2 border">ID</th>
							<th class="px-3 py-2 border">店舗</th>
							<th class="px-3 py-2 border">マシンコード</th>
							<th class="px-3 py-2 border">マシン名</th>
							<th class="px-3 py-2 border">休止開始日時</th>
							<th class="px-3 py-2 border">休止終了日時</th>
							<th class="px-3 py-2 border">休止理由</th>
							<th class="px-3 py-2 border">操作</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($records as $report)
							<tr class="odd:bg-gray-100 even:bg-white hover:bg-indigo-100 transition">
								<td class="px-3 py-2 border">{{ $report->id }}</td>
								<td class="px-3 py-2 border">{{ $report->branch_name }}</td>
								<td class="px-3 py-2 border">{{ $report->machine_code }}</td>
								<td class="px-3 py-2 border">{{ $report->machine_name }}</td>
								<td class="px-3 py-2 border">{{ $report->downtime_start }}</td>
								<td class="px-3 py-2 border">{{ $report->downtime_end ?? '未設定' }}</td>
								<td class="px-3 py-2 border">{{ $report->reason }}</td>
								<td class="px-3 py-2 border">
									<a href="{{ route('machine_downtimes.edit', $report->id) }}"
									   class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
										編集
									</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>

			@else
				<p class="text-gray-500 p-4">休止データがありません。</p>
			@endif
		</div>
	</div>
</x-app-layout>