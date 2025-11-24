<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">店舗別マシン集計一覧</h2>
	</x-slot>

	<div class="container">
		<h1 class="text-xl font-bold mb-4">休止マシン一覧</h1>

		<!-- 店舗選択プルダウン -->

		<!-- 一覧テーブル -->
		<table class="table-auto w-full border-collapse border">
			<thead>
				<tr class="bg-gray-200">
					<th class="border px-4 py-2">店舗</th>
					<th class="border px-4 py-2">マシン</th>
					<th class="border px-4 py-2">休止時間 (h)</th>
					<th class="border px-4 py-2">損失額 (円)</th>
				</tr>
			</thead>
			<tbody>
				@foreach($machines as $machine)
					<tr>
						<td class="border px-4 py-2">{{ $machine->machine_code }}</td>
						<td class="border px-4 py-2">{{ $machine->downtime_start }}</td>
						<td class="border px-4 py-2">{{ $machine->downtime_end }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<!-- 店舗合計 -->
	</div>

</x-app-layout>