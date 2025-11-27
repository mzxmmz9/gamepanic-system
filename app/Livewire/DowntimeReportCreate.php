<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class DowntimeReportCreate extends Component
{
	public $selectedMachineCode;
    public $machine_code;
    public $downtime_start;
    public $downtime_end;
    public $reason;

    public function confirm()
    {
        // 入力チェック
        $validated = $this->validate([
			'machine_code'    => 'required|string',
			'downtime_start'  => 'required|date',
			'downtime_end'    => 'nullable|date|after_or_equal:downtime_start',
			'reason'          => 'nullable|string|max:500',
		]);
			
        session(['report_data' => $validated]);

        return redirect()->route('machine_downtimes.confirm');
        
    }

    public function render()
    {
        return view('livewire.downtime-report-create');
    }

    #[On('reflectForm')]
	public function reflectForm(string $selectedMachineCode)
	{
		$this->selectedMachineCode = $selectedMachineCode;
		$this->machine_code = $selectedMachineCode;
	}

}
