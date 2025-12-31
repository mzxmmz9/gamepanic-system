<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Machine;
use App\Models\MachineBranch;
use App\Models\FailureReport;

class FailureReportFormCreate extends Component
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

	public function render()
	{
		return view('livewire.failure-report-form-create');
	}

	#[On('reflectForm')]
	public function reflectForm(string $selectedMachineCode)
	{
		$code = $selectedMachineCode;
		$this->machine_code = $code;
		$this->branch_id = MachineBranch::find($code)?->branch_id;
		$this->machine_name = Machine::find($code)?->name;

		$unresolvedReport = FailureReport::where('machine_code', $code)
			->orderBy('occurred_at', 'desc')//発生日が最新のもの
			->orderBy('created_at', 'desc')//同日があれば作成日で絞る
			->first();
	}

	public function submit()
	{

		$validated = $this->validate([
			'branch_id' => 'required',
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
		return redirect()->route('failure_reports.confirm');
	}



}