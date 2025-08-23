<!-- Вариации (показывается только если тип продукта = 2) -->
<div id="variationsSection" class=" pb-6 {{ $product->product_type_id != 2 ? 'hidden' : '' }}">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium text-gray-800">Вариации продукта</h3>
        <button type="button" id="addOption"
                class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
            <i class="fas fa-plus mr-1"></i> Добавить опцию
        </button>
    </div>

    <div id="optionsContainer" class="space-y-4">
        @foreach($product->variations as $option)
            <div class="p-4 bg-gray-50 rounded-md" data-option-id="{{ $option->id }}">
                <div class="flex justify-between items-center mb-3">
                    <h5 class="font-medium text-gray-700">Опция</h5>
                    <button type="button" class="text-red-500 hover:text-red-700 remove-option">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <x-form.input
                        name="options[{{ $option->id }}][name]"
                        label="Название опции"
                        type="text"
                        required="true"
                        placeholder="Введите название опции"
                        :value="$option->name"
                    />
                        <x-form.input
                            name="options[{{ $option->id }}][values]"
                            label="Значения (через запятую)"
                            type="text"
                            required="true"
                            placeholder="Например: Красный, Синий, Зеленый"
                            :value="implode(', ', json_decode($option->options, true))"
                        />
                </div>
            </div>
        @endforeach
    </div>
</div>
