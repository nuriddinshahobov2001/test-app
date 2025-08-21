@extends('app')

@section('content')
    <div class="flex items-end justify-end mb-2">
        <a href="{{ route('products.create') }}" class="bg-blue-600 text-white shadow px-5 py-2 rounded-sm">Create</a>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="py-4 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Список продуктов</h2>
        </div>

        <!-- Таблица -->
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <!-- Заголовок таблицы -->
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Имя</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Тип</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Категория</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата регистрации</th>
                </tr>
                </thead>
                <!-- Тело таблицы -->
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr class="hover:bg-gray-50 transition-colors duration-150">

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $product->name }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($product->product_type_id == 1)
                                <span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Простой</span>
                            @elseif($product->product_type_id == 2)
                                <span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-200 text-yellow-800">Вариация</span>
                            @else
                                <span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-200 text-blue-800">Комбо</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
