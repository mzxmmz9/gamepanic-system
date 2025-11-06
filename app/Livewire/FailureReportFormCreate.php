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
	public $branch;
	public $machine_code, $machine_name;
	public $occurred_at, $occurred_by;
	public $process;
	public $st_num;
	public $malfunction;
	public $resumed_at, $resumed_by;
	public $note;

	#[On('reflectForm')]
	public function reflectForm(string $selectedMachineCode)
	{
		$code = $selectedMachineCode;
		$this->machine_code = $code;
		$this->branch = MachineBranch::find($code)?->branch_id;
		$this->machine_name = Machine::find($code)?->name;

		$unresolvedReport = FailureReport::where('machine_code', $code)
			->orderBy('occurred_at', 'desc')//発生日が最新のもの
			->orderBy('created_at', 'desc')//同日があれば作成日で絞る
			->first();
		//対象のマシンコードかつ稼働日null(故障中)のレポートが存在する場合はそれをベースにする
		if($unresolvedReport && ($unresolvedReport->resumed_at) === null ){
			$this->id = $unresolvedReport->id;
			$this->occurred_at = $unresolvedReport->occurred_at;
			$this->occurred_by = $unresolvedReport->occurred_by;
			$this->process = $unresolvedReport->process;
			$this->st_num = $unresolvedReport->st_num;
			$this->malfunction = $unresolvedReport->malfunction;
			$this->note = $unresolvedReport->note;
		}
	}

	public function submit()
	{
		FailureReport::create([
			'branch_id' => $this->branch,
			'occurred_at' => $this->occurred_at,
			'occurred_by' => $this->occurred_by,
			'process' => $this->process,
			'machine_code' => $this->machine_code,
			'machine_name' => $this->machine_name,
			'st_num' => $this->st_num,
			'malfunction' => $this->malfunction,
			'resumed_at' => $this->resumed_at,
			'resumed_by' => $this->resumed_by,
			'note' => $this->note,
		]);

		session()->flash('message', '報告書を送信しました');
	}

	public function render()
	{
		return view('livewire.failure-report-form-create');
	}
}