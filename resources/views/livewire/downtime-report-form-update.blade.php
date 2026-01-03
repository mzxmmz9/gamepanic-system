<div id="downtime-form" class="mt-10 bg-white p-6 rounded-lg shadow border">

	<h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">
		休止情報の編集
	</h3>

	@if (session('success'))
		<p class="text-green-600 font-semibold mb-3">{{ session('success') }}</p>
	@endif

	<form wire:submit.prevent="update" wire:key="{{ $machine_code }}" class="space-y-4">

		<div>
			<label class="font-semibold">資産番号</label>
			<input type="text" class="input" wire:model="machine_code" readonly>
		</div>

		<div>
			<label class="font-semibold">停止開始</label>
			<input type="datetime-local" class="input" wire:model="downtime_start">
		</div>

		<div>
			<label class="font-semibold">停止終了</label>
			<input type="datetime-local" class="input" wire:model="downtime_end">
		</div>

		<div>
			<label class="font-semibold">理由</label>
			<textarea class="input" wire:model="reason"></textarea>
		</div>

		<x-button type="submit" label="更新する" variant="primary" />
	</form>
</div>