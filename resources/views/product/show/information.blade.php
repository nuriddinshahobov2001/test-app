<!-- Основная информация о продукте -->
<div class="p-6 border-b">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Основная информация</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1">Название продукта</label>
                <p class="text-gray-800 font-medium">{{ $product->name }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Категория</label>
                    <p class="text-gray-800">{{ $product->category->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Тип продукта</label>
                    @if($product->product_type_id == 1)
                        <span
                            class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Простой</span>
                    @elseif($product->product_type_id == 2)
                        <span
                            class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-200 text-yellow-800">Вариация</span>
                    @else
                        <span
                            class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-200 text-blue-800">Комбо</span>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">SKU - артикул</label>
                    <p class="text-gray-800">
                        {{ $product->sku ?: 'Нету артикул' }}
                    </p>

                </div>
            </div>
        </div>
        @if($product->photos->first())
            <div class="flex justify-center">
                <div class="w-48 h-48 bg-gray-200 rounded-lg overflow-hidden">
                    <img src="{{asset('storage/'. $product->photos->first()->path)}}" alt="Пицца Маргарита"
                         class="w-full h-full object-cover">
                </div>
            </div>
        @endif

    </div>
</div>
