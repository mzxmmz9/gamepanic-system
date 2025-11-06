@props(['name', 'label', 'type' => 'text', 'required' => false])

<div>
	<label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
		{{ $label }} @if ($required)<span class="text-red-500">*</span>@endif
	</label>

	<input
		type="{{ $type }}"
		id="{{ $name }}"
		name="{{ $name }}"
		{{ $required ? 'required' : '' }}
		value="{{ old($name) }}"
		class="mt-1 block w-full rounded border-gray-300 px-3 py-2 shadow-sm"
	/>

	@error($name)
		<p class="text-sm text-red-500 mt-1">{{ $message }}</p>
	@enderror
</div>