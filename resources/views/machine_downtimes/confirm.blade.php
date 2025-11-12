<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">マシン休止登録</h2>
	</x-slot>

    <form action="{{ route('machine_downtimes.store') }}" method="POST">
        @csrf
        <p>停止理由: {{ $validated['reason'] }}</p>
        <input type="hidden" name="reason" value="{{ $validated['reason'] }}">

        <p>開始日時: {{ $validated['downtime_start'] }}</p>
        <input type="hidden" name="downtime_start" value="{{ $validated['downtime_start'] }}">

        <button type="submit">登録する</button>
        <a href="{{ route('machine_downtimes.create') }}">戻る</a>
    </form>

</x-app-layout>