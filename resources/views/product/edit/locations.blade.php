<!-- Локации и цены -->
<div class="border-b border-gray-200 pb-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium text-gray-800">Локации и цены</h3>
        <button type="button" id="addLocation"
                class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
            <i class="fas fa-plus mr-1"></i> Добавить локацию
        </button>
    </div>

    <div id="locationContainer" class="space-y-4">
        @foreach($product->locations as $location->id => $location)
            <div
                class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 rounded-md border-2 bg-slate-50 border-gray-300 border-dashed"
                data-location-id="{{ $location->id }}">

                <div class="md:col-span-3 font-medium text-gray-700">
{{--                    <x-form.input--}}
{{--                        name="locations[{{ $location->id }}][location_id]"--}}
{{--                        type="hidden"--}}
{{--                        :value="$location->id"--}}
{{--                    />--}}
                    <x-form.input
                        name="locations[{{ $location->id }}][location_name]"
                        label="Имя локации"
                        type="text"
                        required="true"
                        placeholder="Имя локации"
                        :value="$location->location_name"
                    />
                </div>
                <div>
                    <x-form.input
                        name="locations[{{ $location->id }}][selling_price]"
                        label="Цена продажи"
                        type="text"
                        required="true"
                        placeholder="Цена продажи"
                        :value="$location->selling_price"
                        min="0"
                        step="0.01"
                    />
                </div>
                <div>
                    <x-form.input
                        name="locations[{{ $location->id }}][purchase_price]"
                        label="Цена закупки"
                        type="number"
                        required="true"
                        placeholder="Цена закупки"
                        :value="$location->purchase_price"
                        min="0"
                        step="0.01"
                    />
                </div>
                <div>
                    <x-form.input
                        name="locations[{{ $location->id }}][stock]"
                        label="Запас"
                        type="number"
                        required="true"
                        min="0"
                        :value="$location->stock"
                    />
                </div>

                <button type="button"
                        class="remove-location cursor-pointer text-red-500 hover:text-red-700 mt-2 col-span-3">
                    Удалить локацию
                </button>
            </div>
        @endforeach
    </div>
</div>
