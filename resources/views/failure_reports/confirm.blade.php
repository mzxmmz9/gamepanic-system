<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">
			{{ __('故障報告内容の確認') }}
		</h2>
	</x-slot>

	<div class="
		max-w-3xl mx-auto bg-white p-6 mt-8
		rounded-lg shadow border space-y-6
	">
		@php
			$data = session('report_data');
		@endphp

		@if ($data)

			<!-- 見出し -->
			<h2 class="text-lg font-semibold text-gray-700 border-b pb-2">
				入力内容の確認
			</h2>

			<!-- 内容一覧 -->
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

			<!-- ボタンエリア -->
			<div class="pt-6 border-t flex flex-col sm:flex-row gap-3">

				<!-- 戻る -->
				<a href="{{ route('failure_reports.create') }}"
				   class="w-full px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition text-center">
					戻る
				</a>

				<!-- 送信 -->
				<form action="{{ route('failure_reports.store') }}" method="POST" class="w-full">
					@csrf
					<button type="submit"
							class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
						送信する
					</button>
				</form>

			</div>

		@else

			<p class="text-red-600">確認データが見つかりませんでした。</p>
			<a href="{{ route('failure_reports.create') }}" class="text-blue-500 underline">
				フォームに戻る
			</a>

		@endif
	</div>
</x-app-layout>