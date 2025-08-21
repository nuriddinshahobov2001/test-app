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
                <tr class="hover:bg-gray-50 transition-colors duration-150">

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">ivan@example.com</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Активен</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Фрукты</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12.05.2020</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection
