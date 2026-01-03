<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\MachineDowntime;

class DowntimeReportFormUpdate extends Component
{
	public $id;
	public $machine_code;
	public $downtime_start;
	public $downtime_end;
	public $reason;

	#[On('downtimeForm-updateRef')]
	public function reflectUpdateForm($reportJson)
	{
		$selected = is_object($reportJson)
			? (array) $reportJson
			: (is_array($reportJson) ? $reportJson : []);

		$this->id             = $selected['id'] ?? null;
		$this->machine_code   = $selected['machine_code'] ?? null;
		$this->downtime_start = $selected['downtime_start'] ?? null;
		$this->downtime_end   = $selected['downtime_end'] ?? null;
		$this->reason         = $selected['reason'] ?? null;
	}

	public function render()
	{
		return view('livewire.downtime-report-form-update');
	}

}
