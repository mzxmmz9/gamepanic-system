<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8">

        <div class="space-y-4">
            <h3>故障</h3>
            <!-- マシン故障発生書作成 -->
            <a href="{{ route('failure-reports.create') }}"
               class="btn btn-primary text-white w-full">
                マシン故障発生書
            </a>

            <!-- マシン復旧日登録 -->
            <a href="{{ route('failure-reports.index') }}"
               class="btn btn-primary text-white w-full">
                故障マシンの復旧日時
            </a>
            <hr>
            <h3>休止</h3>
            <!-- マシン休止登録 -->
            <a href="{{ route('machine_downtimes.create') }}"
               class="btn btn-primary text-white w-full">
                マシンの休止開始日時
            </a>

            <!-- マシン休止終了 -->
            <a href="{{ route('machine_downtimes.index') }}"
               class="btn btn-primary text-white w-full">
                休止中マシンの休止終了日時
            </a>
        </div>
    </div>
</x-app-layout>