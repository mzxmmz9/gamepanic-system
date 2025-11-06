@props(['name', 'label', 'rows' => 3, 'required' => false])

<div>
	<label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
		{{ $label }} @if ($required)<span class="text-red-500">*</span>@endif
	</label>

	<textarea
		id="{{ $name }}"
		name="{{ $name }}"
		rows="{{ $rows }}"
		{{ $required ? 'required' : '' }}
		class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
	>{{ old($name) }}</textarea>

	@error($name)
		<p class="text-sm text-red-500 mt-1">{{ $message }}</p>
	@enderror
</div>