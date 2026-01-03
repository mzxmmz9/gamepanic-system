<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

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
		dd($reportJson);
		$selected = is_object($reportJson)
			? (array) $reportJson
			: (is_array($reportJson) ? $reportJson : []);

		$this->id             = $selected['id'] ?? null;
		$this->machine_code   = $selected['machine_code'] ?? null;
		$this->downtime_start = $selected['downtime_start'] ?? null;
		$this->downtime_end   = $selected['downtime_end'] ?? null;
		$this->reason         = $selected['reason'] ?? null;
	}

	public function update()
	{
		\App\Models\MachineDowntime::where('id', $this->id)->update([
			'downtime_start' => $this->downtime_start,
			'downtime_end'   => $this->downtime_end,
			'reason'         => $this->reason,
		]);

		session()->flash('success', '休止情報を更新しました。');
	}

	public function render()
	{
		return view('livewire.downtime-report-form-update');
	}

}
