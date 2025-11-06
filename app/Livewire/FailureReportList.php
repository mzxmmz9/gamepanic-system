<?php

namespace App\Livewire;

use Livewire\Component;

class FailureReportList extends Component
{
	public $reports;

	public function mount($reports)
	{
		$this->reports = $reports;
	}

	public function render()
	{
		return view('livewire.failure-report-list');
	}
}
