<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class FailureReportFormUpdate extends Component
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

	#[On('reportForm-updateRef')]
	public function reflectUpdateForm($reportJson)
	{
		$selectedReport = is_object($reportJson)
			? (array) $reportJson
			: (is_array($reportJson) ? $reportJson : []);

		$this->id = $selectedReport['id'] ?? null;
		$this->occurred_at = $selectedReport['occurred_at'] ?? null;
		$this->occurred_by = $selectedReport['occurred_by'] ?? null;
		$this->process = $selectedReport['process'] ?? null;
		$this->machine_code = $selectedReport['machine_code'] ?? null;
		$this->machine_name = $selectedReport['machine_name'] ?? null;
		$this->st_num = $selectedReport['st_num'] ?? null;
		$this->malfunction = $selectedReport['malfunction'] ?? null;
		$this->note = $selectedReport['note'] ?? null;
	}

	public function update()
	{
		FailureReport::update([
			'resumed_at' => $this->resumed_at,
			'resumed_by' => $this->resumed_by,
			'note' => $this->note,
		]);
	}

	public function render()
	{
		return view('livewire.failure-report-form-update');
	}
}
