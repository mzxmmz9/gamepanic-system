@props(['name', 'label', 'options' => [], 'required' => false])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }} @if ($required)<span class="text-red-500">*</span>@endif
    </label>

    <select name="{{ $name }}" id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
    >
        <option value="">選択してください</option>
        @foreach ($options as $option)
            <option value="{{ $option }}" @selected(old($name) === $option)>
                {{ $option }}
            </option>
        @endforeach
    </select>

    @error($name)
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>