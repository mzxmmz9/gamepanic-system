<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
	</x-slot>
	<div class="
		max-w-4xl min-w-max 
		w-[100%] sm:w-[100%] md:w-[70%] lg:w-[60%] xl:w-[50%]
		 mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8
	">
		<livewire:machine-selector />
		<livewire:failure-report-machine-detail 
			:showMachineCode="$machineCode ?? ''"
			:selectedBranch="$selectedBranch ?? ''"
		/>
	</div>

</x-app-layout>