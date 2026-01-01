<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">店舗別マシン集計一覧</h2>
	</x-slot>
	<div class="
		max-w-4xl 
		mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8
	">

		<!-- 店舗選択フォーム -->
		<form method="GET" action="{{ route('machine_aggregators.index') }}" class="flex flex-col md:flex-row gap-4">
			<div>
				{{-- 店舗プルダウン --}}
				<select name="branch_id" class="border p-2">
					<option value="">全店舗</option>
					@foreach ($branches as $branch)
						<option value="{{ $branch->id }}" {{ $branchId == $branch->id ? 'selected' : '' }}>
							{{ $branch->name }}
						</option>
					@endforeach
				</select>
			</div>
			<div>
				<span>休止開始期間</span>
				{{-- 期間 From --}}
				<input type="date" name="from" value="{{ $from }}" class="border p-2">
				<span>～</span>
				{{-- 期間 To --}}
				<input type="date" name="to" value="{{ $to }}" class="border p-2">
			</div>
			<button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">検索</button>
		</form>

		<div>
			{{-- Excel出力ボタン --}}
			<a href="{{ route('export.machine', [
				'branch_id' => $branchId,
				'from'      => $from,
				'to'        => $to,
			]) }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
				Excel出力
			</a>
		</div>


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
						<td class="border px-4 py-2">{{ \Carbon\Carbon::parse( $machine->downtime_start )->format('Y年m月d日 H:i') }}</td>
						<td class="border px-4 py-2">{{ $machine->downtime_end ? \Carbon\Carbon::parse($machine->downtime_end)->format('Y年m月d日 H:i') : '' }}</td>
						<td class="border px-4 py-2">{{ $machine->downtime_diff ?? '-' }}</td>
						<td class="border px-4 py-2">{{ number_format($machine->loss_amount) }} 円</td>
					</tr>
				@endforeach
			</tbody>
		</table>

	</div>
</x-app-layout>