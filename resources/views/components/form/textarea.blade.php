@props([
    'name',
    'label',
    'required' => false,
    'placeholder' => null,
    'value' => null,
    'rows' => 4,
    'id' => null,
])

@php
    $id = $id ?? $name;
    $required = filter_var($required, FILTER_VALIDATE_BOOLEAN);
@endphp

<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if($required) <span class="text-red-500">*</span> @endif
    </label>
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500']) }}
    >{{ old($name, $value) }}</textarea>

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>


{{--<x-textarea--}}
{{--    name="description"--}}
{{--    label="Описание продукта"--}}
{{--    rows="5"--}}
{{--    placeholder="Подробное описание продукта..."--}}
{{--/>--}}
