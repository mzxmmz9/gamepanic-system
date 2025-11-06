<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Branch;
use App\Models\Machine;
use App\Models\MachineBranch;
use App\Models\ViewMachine;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MachineSelector extends Component
{
	public string $keyword = '';
	public $selectedBranch = '';

	public $branches = [];
	public $machines = [];

	public ?string $selectedMachineCode = '';

	public function mount(){
		$this->branches = Branch::orderBy('name')->get();
	}

	public function search()
	{
		// 店舗に紐づく machine_code を取得
		$machineCode = $this->selectedBranch !== ''
			? MachineBranch::where('branch_id', $this->selectedBranch)->pluck('machine_code')->toArray()
			: [];

		// キーワードでマシン名を検索
		$machineQuery = Machine::query();
		if ($this->keyword !== '') {
			$normalized = mb_convert_kana($this->keyword, 'KVas');
			$keywords = array_filter(preg_split('/[\s　]+/u', trim($normalized)));

			$machineQuery->where(function ($query) use ($keywords) {
				foreach ($keywords as $word) {
				$variants = array_unique([
					$word,
					mb_convert_kana($word, 'C'), // ひらがな → カタカナ
					mb_convert_kana($word, 'H'), // カタカナ → ひらがな
				]);

					$query->where(function ($sub) use ($variants) {
						foreach ($variants as $variant) {
							$sub->orWhere('name', 'LIKE', "%{$variant}%");
						}
					});
				}
			});
		}

		// machine_codeとcodeをand検索
		if (!empty($machineCode)) {
			$machineQuery->whereIn('code', $machineCode);
		}

		// マシン一覧を取得
		$this->machines = $machineQuery->get();
	}



	public function render()
	{
		return view('livewire.machine-selector');
	}
}

