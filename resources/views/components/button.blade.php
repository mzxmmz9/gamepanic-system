@props([
	'type' => 'button',
	'variant' => 'primary',
	'label',
])

@php
	$base = 'px-8 py-2 rounded transition focus:outline-none focus:ring-2';
	$styles = [
		'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500',
		'secondary' => 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 focus:ring-gray-400',
		'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
	];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "$base {$styles[$variant]}"]) }}>
	{{ $label }}
</button>