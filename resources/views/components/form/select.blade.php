@props([
    'name',
    'label',
    'options' => [],
    'selected' => null,
    'required' => false,
    'placeholder' => null,
    'defaultOption' => null,
    'id' => null,
])

@php
    $id = $id ?? $name;
    $required = filter_var($required, FILTER_VALIDATE_BOOLEAN);
    $selected = old($name, $selected);
@endphp

<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <select
        id="{{ $id }}"
        name="{{ $name }}"
        @if($required) required @endif
        {{ $attributes->merge(['class' => 'w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500']) }}
    >

        <option selected value="">{{ $defaultOption }}</option>
        @foreach($options as $value)
            <option value="{{ $value->id }}" {{ $selected == $value->id ? 'selected' : '' }}>
                {{ $value->name }}
            </option>
        @endforeach

    </select>

    {{--    @error($name)--}}
    {{--    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>--}}
    {{--    @enderror--}}
</div>


{{--<x-select--}}
{{--    name="category_id"--}}
{{--    label="Категория"--}}
{{--    :options="[--}}
{{--        '' => 'Выберите категорию',--}}
{{--        '1' => 'Электроника',--}}
{{--        '2' => 'Одежда', --}}
{{--        '3' => 'Продукты питания',--}}
{{--        '4' => 'Книги'--}}
{{--    ]"--}}
{{--    required="true"--}}
{{--/>--}}
