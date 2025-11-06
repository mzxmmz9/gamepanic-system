<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">
			{{ __('Edit') }}
		</h2>
	</x-slot>

	<form method="POST" action="{{ route('failure-reports.store') }}">
		@csrf
		@foreach($input as $key => $value)
			<input type="hidden" name="{{ $key }}" value="{{ $value }}">
		@endforeach

		<div>
			<p>店舗名：{{ $input['store_name'] }}</p>
			{{-- 表示だけの確認UI、各項目に対応 --}}
		</div>
		<button type="submit" class="bg-gray-300 px-4 py-2 rounded">登録する</button>
	</form>
	<form method="POST" action="{{ route('failure-reports.back') }}">
		@csrf
		@foreach($input as $key => $value)
			<input type="hidden" name="{{ $key }}" value="{{ $value }}">
		@endforeach
		<button type="submit" class="bg-gray-300 px-4 py-2 rounded">戻る</button>
	</form>

</x-app-layout>