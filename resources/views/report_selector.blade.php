<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
	</x-slot>

	<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8">

		<div class="space-y-4">
			<h3>故障</h3>

			<!-- マシン故障発生書作成 -->
			<a href="{{ route('failure-reports.create') }}"
			   class="w-full block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-center">
				マシン故障発生書
			</a>

			<!-- マシン復旧日登録 -->
			<a href="{{ route('failure-reports.index') }}"
			   class="w-full block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-center">
				故障マシンの復旧日時
			</a>

			<hr>

			<h3>休止</h3>

			<!-- マシン休止登録 -->
			<a href="{{ route('machine_downtimes.create') }}"
			   class="w-full block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-center">
				マシンの休止開始日時
			</a>

			<!-- マシン休止終了 -->
			<a href="{{ route('machine_downtimes.index') }}"
			   class="w-full block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-center">
				休止中マシンの休止終了日時
			</a>
		</div>
	</div>
</x-app-layout>