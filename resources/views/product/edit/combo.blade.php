<!-- Комбо состав (показывается только если тип продукта = 3) -->
<div id="comboSection" class="border-b border-gray-200 pb-6 {{ $product->product_type_id != 3 ? 'hidden' : '' }}">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium text-gray-800">Состав комбо</h3>
        <button type="button" id="addComponent"
                class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
            <i class="fas fa-plus mr-1"></i> Добавить компонент
        </button>
    </div>

    <div id="componentsContainer" class="space-y-4">
        @foreach($product->combos as $combo)

            <div class="p-4 bg-gray-50 rounded-md" data-component-id="{{ $combo->id }}">
                <div class="flex justify-between items-center mb-3">
                    <h5 class="font-medium text-gray-700">Компонент</h5>
                    <button type="button" class="text-red-500 hover:text-red-700 remove-component">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">

                    <x-form.select
                        name="components[{{ $combo->id }}][product]"
                        label="Продукт"
                        default-option="Выберите продукт"
                        :options="$products"
                        required="true"
                        id="category"
                        :selected="$combo->combo_id"
                    />
                    <x-form.input
                        name="components[{{ $combo->id }}][quantity]"
                        label="Количество"
                        type="number"
                        required="true"
                        placeholder="Введите количество"
                        min="1"
                        :value="$combo->quantity"
                    />
                </div>
            </div>
        @endforeach
    </div>
</div>
