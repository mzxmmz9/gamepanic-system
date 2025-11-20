<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">報告種別の選択</h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md space-y-6 mt-8">
        <p class="text-gray-700 text-base">登録する内容を選択してください。</p>

        <div class="space-y-4">
            <!-- マシン故障発生書作成 -->
            <a href="{{ route('failure-reports.create') }}"
               class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-3 px-4 rounded transition shadow-sm">
                マシン故障発生書
            </a>

            <!-- マシン復旧日登録 -->
            <a href="{{ route('failure-reports.index') }}"
               class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-3 px-4 rounded transition shadow-sm">
                故障マシンの復旧日時
            </a>

            <!-- マシン休止登録 -->
            <a href="{{ route('machine_downtimes.create') }}"
               class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-3 px-4 rounded transition shadow-sm">
                マシンの休止開始日時
            </a>

            <!-- マシン休止終了 -->
            <a href="{{ route('machine_downtimes.index') }}"
               class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center font-medium py-3 px-4 rounded transition shadow-sm">
                休止中マシンの休止終了日時
            </a>
        </div>
    </div>
</x-app-layout>