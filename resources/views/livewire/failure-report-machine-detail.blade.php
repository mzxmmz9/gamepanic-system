<div id="machine-detail" class="mt-6">
	<div class="bg-white shadow-sm border rounded-lg p-6">
		
		@if (!empty($selectedMachine))
			{{-- 選択マシン情報 --}}
			<h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">選択中のマシン情報</h3>

			<div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 text-sm text-gray-700">
				<div><span class="font-semibold">店舗名：</span>{{ $selectedMachine['branch'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">ゲーム機コード：</span>{{ $selectedMachine['code'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">ゲーム機名：</span>{{ $selectedMachine['name'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">基盤名：</span>{{ $selectedMachine['board'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">種別名：</span>{{ $selectedMachine['category'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">設置場所：</span>{{ $selectedMachine['location'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">状態：</span>{{ $selectedMachine['status'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">通信シリアル：</span>{{ $selectedMachine['serial'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">システムID：</span>{{ $selectedMachine['system_id'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">プラン：</span>{{ $selectedMachine['plan'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">購入金額(税込)：</span>{{ $selectedMachine['price'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">面積：</span>{{ $selectedMachine['area'] ?? '情報なし' }}</div>
				<div><span class="font-semibold">会社区分：</span>{{ $selectedMachine['ownership'] ?? '情報なし' }}</div>
				<div class="md:col-span-2"><span class="font-semibold">本社コメント：</span>{{ $selectedMachine['note'] ?? '情報なし' }}</div>

			</div>

			{{-- 選択マシン情報end --}}
			<hr class="my-6 border-t border-dashed border-gray-300">

			<div class="text-right">
				<form method="POST" action="{{ route('failure_reports.form-create') }}">
					@csrf

					{{-- Livewire の値を hidden で送る --}}
					@foreach ($selectedMachine as $key => $value)
						<input type="hidden" name="machine[{{ $key }}]" value="{{ $value }}">
					@endforeach
					<input type="hidden" name="machine[selected_branch]" value="{{ $selectedBranch }}">

					<button
						type="submit"
						class="px-4 py-2 bg-gray-200 rounded"
					>
						このマシンについて起票する
					</button>
				</form>
			</div>
		@else
			<p class="text-gray-500">マシンが選択されていません</p>
		@endif
	</div>
</div>