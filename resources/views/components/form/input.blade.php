@props([
    'name',
    'label',
    'type' => 'text',
    'required' => false,
    'placeholder' => null,
    'value' => null,
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
    <input
        type="{{ $type }}"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500']) }}
    >

    @error($name)
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>


{{--<x-form.input--}}
{{--    name="name"--}}
{{--    label="Название продукта"--}}
{{--    type="text"--}}
{{--    required="true"--}}
{{--    placeholder="Введите название продукта"--}}
{{--/>--}}
