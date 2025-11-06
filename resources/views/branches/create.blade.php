<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-bold text-gray-800">支店登録</h2>
	</x-slot>

	<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
		<form method="POST" action="{{ route('branches.store') }}">
			@csrf

			<div class="space-y-4">
				<div>
					<label for="name" class="block text-sm font-medium">支店名</label>
					<input type="text" name="name" id="name" required class="w-full border rounded px-3 py-2" />
				</div>

				<div>
					<label for="code" class="block text-sm font-medium">支店コード</label>
					<input type="text" name="code" id="code" required class="w-full border rounded px-3 py-2" />
				</div>

				<div>
					<label for="location" class="block text-sm font-medium">地域</label>
					<input type="text" name="location" id="location" class="w-full border rounded px-3 py-2" />
				</div>

				<div>
					<label for="comment" class="block text-sm font-medium">備考</label>
					<textarea name="comment" id="comment" rows="3" class="w-full border rounded px-3 py-2"></textarea>
				</div>
			</div>

			<div class="mt-6 text-right">
				<button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
					登録する
				</button>
			</div>
		</form>
	</div>
	
</x-app-layout>