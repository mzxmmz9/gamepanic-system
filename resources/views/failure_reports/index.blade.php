<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">報告書選択</h2>
	</x-slot>
	<p>稼働日を入力する報告書を選択してください</p>

	<livewire:failure-report-list :reports="$reports ?? ''"/>

	<livewire:failure-report-detail />

	<livewire:failure-report-form-update :reportJson="$reportJson ?? ''"/>


</x-app-layout>