<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">
			{{ __('休止情報の編集') }}
		</h2>
	</x-slot>

	<p>ID: {{ $report->id }}</p>
	<p>店舗: {{ $report->branch_name }}</p>
	<p>マシンコード: {{ $report->machine_code }}</p>
	<p>マシン名: {{ $report->machine_name }}</p>
	<p>休止開始日時: {{ $report->downtime_start }}</p>
	<p>休止終了日時: {{ $report->downtime_end ?? '未設定' }}</p>
	<p>休止理由: {{ $report->reason }}</p>

	<form action="{{ route('machine_downtimes.update', $report->id) }}" method="POST">
		@csrf
		@method('PUT')
		<input type="hidden" name="downtime_end" value="{{ $report->downtime_end }}">
		<button type="submit">更新する</button>
	</form>

	<a href="{{ route('machine_downtimes.edit', $report->id) }}">戻る</a>

</x-app-layout>