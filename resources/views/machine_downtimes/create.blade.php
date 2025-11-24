<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
    </x-slot>
    <livewire:machine-selector />
    <livewire:failure-report-machine-detail :showMachineCode="$machineCode ?? '' "/>
    <livewire:downtime-report-create :selectedMachineCode="$machineCode ?? '' "/>

</x-app-layout>