<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">店舗別マシン集計一覧</h2>
	</x-slot>

	<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
		<table class="table-auto w-full border-collapse">
			<thead class="bg-gray-100">
				<tr>
					<th class="border px-4 py-2">店舗</th>
					<th class="border px-4 py-2">設置台数</th>
					<th class="border px-4 py-2">稼働</th>
					<th class="border px-4 py-2">休止</th>
					<th class="border px-4 py-2">故障停止</th>
					<th class="border px-4 py-2">稼働率</th>
					<th class="border px-4 py-2">暫定案件</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($branches as $branch)
					<tr>
						<td class="border px-4 py-2">{{ $branch->name }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</x-app-layout>