<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    protected array $safeData = [];

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'product_type_id' => ['required', 'numeric', 'exists:product_types,id'],
            'brand_id' => ['nullable', 'numeric', 'exists:brands,id', 'min:0'],
            'category_id' => ['nullable', 'numeric', 'exists:categories,id', 'min:0'],
            'currency_id' => ['nullable', 'numeric', 'exists:currencies,id', 'min:0'],
            'photos' => ['sometimes', 'nullable', 'array'],
            'locations' => ['sometimes', 'nullable', 'array'],
        ];

        return array_merge($rules, $this->getTypeSpecificRules());
    }

    private function getTypeSpecificRules(): array
    {
        return match ((int)$this->input('product_type_id')) {
            2 => $this->variationRules(),
            3 => $this->comboRules(),
            default => [],
        };
    }

    private function variationRules(): array
    {
        return [
            'options' => ['required', 'array', 'min:1'],
            'options.*.name' => ['required', 'string', 'max:255'],
            'options.*.values' => ['required', 'string'],
        ];
    }

    private function comboRules(): array
    {
        return [
            'components' => ['required', 'array', 'min:1'],
            'components.*.product' => ['required', 'numeric', 'exists:products,id'],
            'components.*.quantity' => ['required', 'numeric', 'min:0'],
        ];
    }

    protected function passedValidation(): void
    {
        $this->safeData = $this->validated();
    }

    public function safe(?array $keys = null): array
    {
        return $this->safeData;
    }

    public function messages(): array
    {
        return [
            // Общие
            'name.required' => 'Название продукта обязательно.',
            'name.string' => 'Название продукта должно быть строкой.',
            'type.required' => 'Тип продукта обязателен.',
            'type.exists' => 'Указанный тип продукта не найден.',
            'brand.exists' => 'Выбранный бренд не существует.',
            'category.exists' => 'Выбранная категория не существует.',
            'currency.exists' => 'Выбранная валюта не существует.',

            // Вариация (type = 2)
            'options.required' => 'Необходимо указать хотя бы одну опцию.',
            'options.array' => 'Опции должны быть массивом.',
            'options.*.name.required' => 'Название каждой опции обязательно.',
            'options.*.name.string' => 'Название опции должно быть строкой.',
            'options.*.values.required' => 'Значения опции обязательны.',
            'options.*.values.string' => 'Значения опции должны быть строкой.',

            // Комбо (type = 3)
            'components.required' => 'Необходимо указать хотя бы один компонент.',
            'components.array' => 'Компоненты должны быть массивом.',
            'components.*.product.required' => 'Для каждого компонента нужно указать продукт.',
            'components.*.product.exists' => 'Один из выбранных продуктов для компонента не существует.',
            'components.*.quantity.required' => 'Количество для компонента обязательно.',
            'components.*.quantity.numeric' => 'Количество должно быть числом.',
            'components.*.quantity.min' => 'Количество компонента должно быть не меньше 0.',
        ];
    }
}
