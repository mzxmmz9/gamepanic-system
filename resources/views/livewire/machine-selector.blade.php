<div>

	<div>
		<label class="inline-block w-24 mr-4">店舗</label>
		<select name="branch" wire:model="selectedBranch">
			<option value="">選択してください</option>
			@foreach ($branches as $branch)
				<option value="{{ $branch->id }}">{{ $branch->name }}</option>
			@endforeach
		</select>
	</div>

	<div>
		<label class="inline-block w-24 mr-4">マシン名</label>
		<input type="text" wire:model="keyword" placeholder="マシン名を検索">
	</div>

	<x-button wire:click="search" label="検索" variant="secondary" class="my-4"/>

	<div class="max-h-80 overflow-y-auto p-4 border rounded bg-white shadow">

		@if(count($machines) > 0)

			<table class="min-w-full text-sm text-left border-collapse">
				<thead class="bg-gray-200 text-gray-700 sticky top-0">
					<tr>
						<th class="px-3 py-2 border">マシンコード</th>
						<th class="px-3 py-2 border">マシン名</th>
					</tr>
				</thead>

				<tbody>
					@foreach($machines as $machine)
						<tr
							wire:click="$dispatch('updateDetail', { showMachineCode: '{{ $machine->code }}' })"
							wire:key="{{ $machine->code }}"
							class="cursor-pointer odd:bg-gray-100 even:bg-white hover:bg-indigo-100 transition"
							x-on:click="document.getElementById('machine-detail')?.scrollIntoView({ behavior: 'smooth' })"
						>
							<td class="px-3 py-2 border">{{ $machine->code }}</td>
							<td class="px-3 py-2 border">{{ $machine->name }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>

		@else
			<p class="text-gray-500">検索結果をここに表示します</p>
		@endif

	</div>

</div>