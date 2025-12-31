<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class FailureReportFormUpdate extends Component
{
	public $id;
	public $branch_id;
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

    public function submit()
    {
        $validated = $this->validate([
        	'branch_id' => 'required|string',
            'occurred_at' => 'required|date',
            'occurred_by' => 'required|string',
            'process' => 'required|string',
            'machine_code' => 'required|string',
            'machine_name' => 'required|string',
            'st_num' => 'nullable|string',
            'malfunction' => 'required|string',
            'note' => 'nullable|string',
        ]);

        session(['report_data' => $validated]);
        return redirect()->route('failure_reports.confirm_update');
    }

}
