<!-- Локации и цены -->
<div class="p-6 border-b">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Локации и цены</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Локация</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Цена продажи</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Цена закупки</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Запас</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($product->locations as $location)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $location->location_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $location->selling_price }} {{ $product->currency->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $location->purchase_price }} {{ $product->currency->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $location->stock }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
