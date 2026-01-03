<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class DowntimeReportDetail extends Component
{
	public array $selectedDowntime = [];

	#[On('downtimeDetail-Show')]
	public function handleShowDowntime($reportJson): void
	{
		$this->selectedDowntime = is_object($reportJson)
			? (array) $reportJson
			: (is_array($reportJson) ? $reportJson : []);
	}

	public function render()
	{
		return view('livewire.downtime-report-detail');
	}
}