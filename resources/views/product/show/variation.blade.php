<!-- Вариации (если есть) -->
<div class="p-6 border-b">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Вариации продукта</h2>
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
        <div class="flex">
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    Этот продукт имеет вариации.
                </p>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Название
                    опции
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Значения</th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($product->variations as $variation)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $variation->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                        @foreach(json_decode($variation->options) as $item)
                            <span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $item }}</span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
