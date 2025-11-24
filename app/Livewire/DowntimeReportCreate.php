<?php

namespace App\Livewire;

use Livewire\Component;

class DowntimeReportCreate extends Component
{
	public $id;
	public $branch;
	public $machine_code, $machine_name;
	public $occurred_at, $occurred_by;
	public $process;
	public $st_num;
	public $malfunction;
	public $resumed_at, $resumed_by;
	public $note;
    public function render()
    {
        return view('livewire.downtime-report-create');
    }

    #[On('reflectForm')]
	public function reflectForm(string $selectedMachineCode)
	{
		$code = $selectedMachineCode;
		$this->machine_code = $code;
	}
}
