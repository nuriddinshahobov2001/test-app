<!-- Комбо-состав (если есть) -->
<div class="p-6 border-b">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Состав комбо</h2>
    <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-4">
        <div class="flex">
            <div class="ml-3">
                <p class="text-sm text-blue-700">
                    Этот продукт является комбо-набором и включает следующие компоненты.
                </p>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Продукт</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Количество</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($product->combos as $combo)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $combo->product->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $combo->quantity }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
