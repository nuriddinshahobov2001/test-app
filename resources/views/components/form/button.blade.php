@props([
    'type' => 'button',
    'variant' => 'primary',
    'id' => null
])

@php
    $baseClasses = 'px-3 py-2 rounded-sm font-medium focus:outline-none cursor-pointer transition duration-200';
    $variants = [
        'primary' => 'bg-blue-600 text-white hover:bg-blue-700',
        'danger'  => 'bg-red-600 text-white hover:bg-red-700',
        'secondary' => 'bg-gray-200 text-gray-700 hover:bg-gray-300',
    ];
    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
