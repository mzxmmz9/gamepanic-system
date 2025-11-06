<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">新規マシン故障発生書</h2>
	</x-slot>
	<div class="m-6 w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%] mx-auto p-6 bg-white rounded-lg shadow-md">
		<livewire:machine-selector />
		<livewire:failure-report-machine-detail :showMachineCode="$machineCode ?? '' "/>
	</div>
	<div>
		<livewire:failure-report-form-create :selectedMachineCode="$machineCode ?? '' "/>
	</div>

</x-app-layout>