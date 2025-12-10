<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class DowntimeReportCreate extends Component
{
	public $machine_code;
	public $downtime_start;
	public $downtime_end;
	public $reason;

	public function render()
	{
		return view('livewire.downtime-report-create');
	}

	#[On('reflectForm')]
	public function reflectForm(string $selectedMachineCode)
	{
		$this->machine_code = $selectedMachineCode;
	}

}
