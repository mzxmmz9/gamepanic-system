<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">
			{{ __('故障報告内容の確認') }}
		</h2>
	</x-slot>

	<div class="
		max-w-4xl min-w-max 
		w-[100%] sm:w-[100%] md:w-[70%] lg:w-[60%] xl:w-[50%]
		 mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8
	">
		@php
			$data = session('report_data');
		@endphp

		@if ($data)
			<div class="space-y-4">
				<div>
					<dt class="font-semibold text-gray-700">発生日</dt>
					<dd class="text-gray-900">{{ $data['occurred_at'] }}</dd>
				</div>
				<div>
					<dt class="font-semibold text-gray-700">発生日担当者</dt>
					<dd class="text-gray-900">{{ $data['occurred_by'] }}</dd>
				</div>
				<div>
					<dt class="font-semibold text-gray-700">対応</dt>
					<dd class="text-gray-900">{{ $data['process'] ?? '未入力' }}</dd>
				</div>
				<div>
					<dt class="font-semibold text-gray-700">資産番号</dt>
					<dd class="text-gray-900">{{ $data['machine_code'] ?? '未入力' }}</dd>
				</div>
				<div>
					<dt class="font-semibold text-gray-700">マシン名</dt>
					<dd class="text-gray-900">{{ $data['machine_name'] ?? '未入力' }}</dd>
				</div>
				<div>
					<dt class="font-semibold text-gray-700">ST番号</dt>
					<dd class="text-gray-900">{{ $data['st_num'] ?? '未入力' }}</dd>
				</div>
				<div>
					<dt class="font-semibold text-gray-700">故障内容</dt>
					<dd class="text-gray-900">{{ $data['malfunction'] ?? '未入力' }}</dd>
				</div>
				<div>
					<dt class="font-semibold text-gray-700">備考</dt>
					<dd class="text-gray-900">{{ $data['note'] ?? '未入力' }}</dd>
				</div>
			</div>

			<div class="mt-8 flex justify-between">
				<a href="{{ route('failure_reports.index') }}"
				   class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
					戻る
				</a>
				<form action="{{ route('failure_reports.update') }}" method="POST">
					@csrf
					<button type="submit"
							class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
						送信する
					</button>
				</form>
			</div>
		@else
			<p class="text-red-600">確認データが見つかりませんでした。</p>
			<a href="{{ route('failure_reports.index') }}" class="text-blue-500 underline">フォームに戻る</a>
		@endif
	</div>
</x-app-layout>