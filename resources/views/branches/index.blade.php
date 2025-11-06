<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">支店一覧</h2>
	</x-slot>

	<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
		<table class="table-auto w-full border-collapse">
			<thead class="bg-gray-100">
				<tr>
					<th class="border px-4 py-2 text-left">支店名</th>
					<th class="border px-4 py-2 text-left">郵便番号</th>
					<th class="border px-4 py-2 text-left">住所</th>
					<th class="border px-4 py-2 text-left">備考</th>
				</tr>
			</thead>
			<tbody>
				@forelse ($branches as $branch)
					<tr>
						<td class="border px-4 py-2">{{ $branch->name }}</td>
						<td class="border px-4 py-2">{{ $branch->postcode }}</td>
						<td class="border px-4 py-2">{{ $branch->address }}</td>
						<td class="border px-4 py-2">{{ $branch->note }}</td>
					</tr>
				@empty
					<tr>
						<td colspan="4" class="text-center py-4 text-gray-500">支店情報が登録されていません。</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>

</x-app-layout>