<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ViewMachine;
use Livewire\Attributes\On;

class FailureReportMachineDetail extends Component
{
	public $showMachineCode = '';
	public $selectedBranch = '';
	public array $selectedMachine = [];


	#[On('updateDetail')]
	public function handleUpdateDetail(string $showMachineCode, string $selectedBranch)
	{
		$this->selectedBranch = $selectedBranch;
		$this->$showMachineCode = $showMachineCode;
		$details = ViewMachine::findCode($showMachineCode);

		$this->selectedMachine = $details
			? $details->toArray()
			: [];
		
	}
	
	public function render()
	{
		return view('livewire.failure-report-machine-detail');
	}
}