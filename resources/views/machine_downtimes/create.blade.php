<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">マシン休止登録</h2>
	</x-slot>

    <div class="m-6 w-[90%] sm:w-[80%] md:w-[70%] lg:w-[60%] xl:w-[50%] mx-auto p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('machine_downtimes.confirm') }}" method="POST">
            @csrf
            <div>
                <label>休止開始日時:</label>
                <input type="datetime-local" id="downtime_start" name="downtime_start" value="{{ old('downtime_start') }}">
            </div>
            <div>
                <label>休止理由:</label>
                <input type="text" name="reason">
            </div>

            <button type="submit">登録</button>
        </form>
    </div>

</x-app-layout>