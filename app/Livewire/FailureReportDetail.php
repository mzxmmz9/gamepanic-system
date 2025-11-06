<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class FailureReportDetail extends Component
{
	public $showReportsId;
	public array $selectedReport = [];

	#[On('reportDetail-ShowReport')]
	public function handleShowReport($reportJson): void
	{
		$this->selectedReport = is_object($reportJson)
			? (array) $reportJson
			: (is_array($reportJson) ? $reportJson : []);
	}

	public function render()
	{
		return view('livewire.failure-report-detail');
	}
}
