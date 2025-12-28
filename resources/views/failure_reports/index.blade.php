<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">報告書選択</h2>
	</x-slot>

	<div class="
		max-w-4xl min-w-max 
		w-[100%] sm:w-[100%] md:w-[70%] lg:w-[60%] xl:w-[50%]
		 mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8
	">
		<p>稼働日を入力する報告書を選択してください</p>
		<livewire:failure-report-list :reports="$reports ?? ''"/>
		<livewire:failure-report-detail />
		<livewire:failure-report-form-update :reportJson="$reportJson ?? ''"/>
	</div>


</x-app-layout>