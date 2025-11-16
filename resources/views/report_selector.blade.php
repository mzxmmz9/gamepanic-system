<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
	</x-slot>

	<div class="max-w-xl mx-auto bg-white p-6 rounded shadow space-y-4">
		<p class="text-gray-700">登録する内容を選択してください。</p>

		<div class="space-y-3">
			<!-- マシン故障発生書作成 -->
			<a href="{{ route('failure-reports.create') }}" class="block px-4 py-2 rounded">
				マシン故障発生書
			</a>
			<!-- マシン復旧日登録 -->
			<a href="{{ route('failure-reports.index') }}" class="block px-4 py-2 rounded">
				故障マシンの復旧日時
			</a>
			<!-- マシン休止登録 -->
			<a href="{{ route('machine_downtimes.create') }}" class="block px-4 py-2 rounded">
				マシンの休止開始日時
			</a>
			<!-- マシン休止終了 -->
			<a href="{{ route('machine_downtimes.index') }}" class="block px-4 py-2 rounded">
				マシンの休止終了日時
			</a>

		</div>
	</div>
</x-app-layout>