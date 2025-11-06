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
			<ul>
				@foreach($machines as $machine)
				<li 
					wire:click="$dispatch('updateDetail', { showMachineCode: '{{ $machine->code }}'} )" 
					wire:key="{{ $machine->code }}" 
					class="p-2 odd:bg-gray-100 even:bg-white" 
					style="cursor:pointer;"
				>
					<span>{{ $machine->code }}</span><span>{{ $machine->name }}</span>
				</li>
				@endforeach
			</ul>
		@else
			<p class="text-gray-500">検索結果をここに表示します</p>
		@endif
	</div>

</div>