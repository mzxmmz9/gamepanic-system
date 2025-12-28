<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">
			{{ __('休止情報の編集') }}
		</h2>
	</x-slot>

	<div class="
		max-w-4xl min-w-max 
		w-[100%] sm:w-[100%] md:w-[70%] lg:w-[60%] xl:w-[50%]
		 mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8
	">
		<div class="space-y-4">
			<div>
				<label class="font-semibold text-gray-700">ID</label>
				<input type="text" class="input input-bordered w-full" value="{{ $report->id }}" disabled />
			</div>
			<div>
				<label class="font-semibold text-gray-700">店舗</label>
				<input type="text" class="input input-bordered w-full" value="{{ $report->branch_name }}" disabled />
			</div>
			<div>
				<label class="font-semibold text-gray-700">マシンコード</label>
				<input type="text" class="input input-bordered w-full" value="{{ $report->machine_code }}" disabled />
			</div>
			<div>
				<label class="font-semibold text-gray-700">マシン名</label>
				<input type="text" class="input input-bordered w-full" value="{{ $report->machine_name }}" disabled />
			</div>
			<div>
				<label class="font-semibold text-gray-700">休止開始日時</label>
				<input type="text" class="input input-bordered w-full" value="{{ $report->downtime_start }}" disabled />
			</div>
			<div>
				<label class="font-semibold text-gray-700">休止終了日時</label>
				<input type="text" class="input input-bordered w-full" value="{{ $report->downtime_end ?? '未設定' }}" disabled />
			</div>
			<div>
				<label class="font-semibold text-gray-700">休止理由</label>
				<input type="text" class="input input-bordered w-full" value="{{ $report->reason }}" disabled />
			</div>
		</div>

		<div class="mt-8 flex justify-between">
			<!-- 戻るボタン -->
			<a href="{{ route('machine_downtimes.edit', $report->id) }}" class="btn btn-secondary">
				戻る
			</a>

			<form action="{{ route('machine_downtimes.update', $report->id) }}" method="POST">
				@csrf
				@method('PUT')
				<input type="hidden" name="downtime_end" value="{{ $report->downtime_end }}">
				<button type="submit" class="btn btn-primary">
					更新する
				</button>
			</form>
		</div>
	</div>
</x-app-layout>