<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
	</x-slot>

	<div class="max-w-xl mx-auto bg-white p-6 rounded shadow space-y-4">
		<p class="text-gray-700">登録したい報告の種類を選択してください：</p>

		<div class="space-y-3">
			<a href="{{ route('failure-reports.create') }}" class="block px-4 py-2 rounded">
				マシン故障発生書を作成する
			</a>

			<a href="{{ route('failure-reports.index') }}" class="block px-4 py-2 rounded">
				マシンの復旧日を入力する
			</a>
		</div>
	</div>
</x-app-layout>