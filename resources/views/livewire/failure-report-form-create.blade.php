<div>
	<form wire:submit.prevent="submit" method="POST" wire:key="{{ $machine_code }}" class="space-y-4" id="report-form">
		@csrf
		<div><label class="inline-block w-24 mr-4">発生日</label><input type="date" wire:model="occurred_at" max="{{ now()->format('Y-m-d') }}" value="{{ $machine_name }}"></div>
		<div><label class="inline-block w-24 mr-4">発生日担当者</label><input type="text" wire:model="occurred_by" value="{{ $machine_name }}" placeholder="発生日担当者"></div>
		<div>
			<label class="inline-block w-24 mr-4">対応</label>
			<select wire:model="process">
				<option value="">選択してください</option>
				<option value="店舗処理">店舗処理</option>
				<option value="メンテナンス相談">メンテナンス相談</option>
			</select>
		</div>
		<div><label class="inline-block w-24 mr-4">資産番号</label><input type="text" wire:model="machine_code" value="{{ $machine_code }}" placeholder="資産番号" readonly></div>
		<div><label class="inline-block w-24 mr-4">マシン名</label><input type="text" wire:model="machine_name" value="{{ $machine_name }}" placeholder="マシン名" readonly></div>
		<div><label class="inline-block w-24 mr-4">ST番号</label><input type="text" wire:model="st_num" value="{{ $st_num }}" placeholder="ST番号"></div>
		<div><label class="inline-block w-24 mr-4">故障内容</label><textarea wire:model="malfunction" value="{{ $malfunction }}" placeholder="故障内容"></textarea></div>
		<div><label class="inline-block w-24 mr-4">備考</label><textarea wire:model="note" value="{{ $note }}" placeholder="備考"></textarea></div>

		<button type="submit">内容を確認する</button>
	</form>
</div>