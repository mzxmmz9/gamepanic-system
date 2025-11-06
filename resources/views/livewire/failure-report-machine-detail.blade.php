<div>
	
	<div class="machine-detail bg-gray-100 p-4 rounded mt-4">
		@if(!empty($selectedMachine))
			{{-- 選択マシン情報 --}}
			<p><strong>店舗名：</strong>{{ $selectedMachine['branch'] ?? '情報なし' }}</p>
			<p><strong>ゲーム機コード：</strong>{{ $selectedMachine['code'] ?? '情報なし' }}</p>
			<p><strong>ゲーム機名：</strong>{{ $selectedMachine['name'] ?? '情報なし' }}</p>
			<p><strong>基盤名：</strong>{{ $selectedMachine['board'] ?? '情報なし' }}</p>
			<p><strong>種別名：</strong>{{ $selectedMachine['category'] ?? '情報なし' }}</p>
			<p><strong>設置場所：</strong>{{ $selectedMachine['location'] ?? '情報なし' }}</p>
			<p><strong>状態：</strong>{{ $selectedMachine['status'] ?? '情報なし' }}</p>
			<p><strong>通信シリアル：</strong>{{ $selectedMachine['serial'] ?? '情報なし' }}</p>
			<p><strong>システムＩＤ：</strong>{{ $selectedMachine['system_id'] ?? '情報なし' }}</p>
			<p><strong>プラン：</strong>{{ $selectedMachine['plan'] ?? '情報なし' }}</p>
			<p><strong>購入金額(税込)：</strong>{{ $selectedMachine['price'] ?? '情報なし' }}</p>
			<p><strong>面積：</strong>{{ $selectedMachine['area'] ?? '情報なし' }}</p>
			<p><strong>会社区分：</strong>{{ $selectedMachine['ownership'] ?? '情報なし' }}</p>
			<p><strong>本社コメント：</strong>{{ $selectedMachine['note'] ?? '情報なし' }}</p>
			{{--
			<p><strong>休止理由・機械状態①：</strong>{{ $selectedMachine[''] }}</p>
			<p><strong>休止理由・機械状態②：</strong>{{ $selectedMachine[''] }}</p>
			<p><strong>休止理由・機械状態③：</strong>{{ $selectedMachine[''] }}</p>
			<p><strong>休止理由・機械状態④：</strong>{{ $selectedMachine[''] }}</p>
			<p><strong>休止理由・機械状態⑤：</strong>{{ $selectedMachine[''] }}</p>
			--}}
			{{-- 選択マシン情報end --}}
			<hr class="my-4 border-t border-dashed border-gray-400">
			<x-button
				wire:click="$dispatch( 'reflectForm', { selectedMachineCode: '{{ $selectedMachine['code'] }}'} )"
				wire:key="{{ $selectedMachine['code'] }}" 
				label="このマシンについて起票する"
				variant="secondary"
			/>
		@else
			<p class="text-gray-500">マシンが選択されていません</p>
		@endif
	</div>


	{{--

--}}
</div>
