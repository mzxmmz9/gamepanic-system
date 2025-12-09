<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">
			{{ __('休止情報の編集') }}
		</h2>
	</x-slot>

	<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded">
		<form action="{{ route('machine_downtimes.update_confirm', $report->id) }}" method="POST">
			@csrf

			<!-- ID（表示のみ） -->
			<div class="mb-4">
				<label class="block font-semibold text-gray-700">ID</label>
				<p class="text-gray-900">{{ $report->id }}</p>
			</div>

			<!-- 店舗名（表示のみ） -->
			<div class="mb-4">
				<label class="block font-semibold text-gray-700">店舗</label>
				<p class="text-gray-900">{{ $report->branch_name }}</p>
			</div>

			<!-- マシンコード（表示のみ） -->
			<div class="mb-4">
				<label class="block font-semibold text-gray-700">マシンコード</label>
				<p class="text-gray-900">{{ $report->machine_code }}</p>
			</div>

			<!-- マシン名（表示のみ） -->
			<div class="mb-4">
				<label class="block font-semibold text-gray-700">マシン名</label>
				<p class="text-gray-900">{{ $report->machine_name }}</p>
			</div>

			<!-- 休止開始日時（表示のみ） -->
			<div class="mb-4">
				<label class="block font-semibold text-gray-700">休止開始日時</label>
				<p class="text-gray-900">{{ $report->downtime_start }}</p>
			</div>

			<!-- 休止終了日時（編集可能） -->
			<div class="mb-4">
				<label for="downtime_end" class="block font-semibold text-gray-700">休止終了日時</label>
				<input type="datetime-local" id="downtime_end" name="downtime_end"
					   value="{{ old('downtime_end', $report->downtime_end) }}"
					   class="w-full border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200">
				@error('downtime_end')
					<p class="text-red-600 text-sm">{{ $message }}</p>
				@enderror
			</div>

			<!-- 休止理由（表示のみ） -->
			<div class="mb-4">
				<label class="block font-semibold text-gray-700">休止理由</label>
				<p class="text-gray-900">{{ $report->reason }}</p>
			</div>

			<!-- ボタン -->
			<div class="mt-6 flex justify-between">
				<a href="{{ route('machine_downtimes.index') }}"
				   class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
					戻る
				</a>
				<button type="submit">確認へ進む</button>
			</div>
		</form>
	</div>
</x-app-layout>