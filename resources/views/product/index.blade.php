@extends('app')

@section('content')
    <div class="flex items-end justify-end mb-2">
        <a href="{{ route('products.create') }}" class="bg-blue-600 text-white shadow px-5 py-2 rounded-sm">Создать</a>
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Категория
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Дата
                        регистрации
                    </th>
                    <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase tracking-wider">Действия
                    </th>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
{{--                            <span class="bg-purple-200 text-purple-700 px-4 py-2 rounded-md">{{ $product->category->name }}</span>--}}
                            {{ $product->category->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->created_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('products.show', $product->id) }}"
                                   class="bg-green-200 text-green-700 px-2 py-1 rounded-md cursor-pointer"><i
                                            class="fas fa-eye"></i></a>
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="bg-blue-200 text-blue-700 px-2 py-1 rounded-md cursor-pointer"><i
                                            class="fas fa-pencil"></i></a>
                                <button type="button"
                                        data-id="{{ $product->id }}"
                                        class="delete-btn bg-red-200 text-red-700 px-2 py-1 rounded-md cursor-pointer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Модальное окно -->
        <div id="deleteModal"
             class="hidden fixed bg-black/40 inset-0 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-lg font-semibold text-gray-800">Удалить продукт?</h2>
                <p class="text-sm text-gray-600 mt-2">Вы уверены, что хотите удалить этот продукт?</p>
                <div class="flex justify-end gap-2 mt-4">
                    <button id="cancelDelete"
                            class="bg-gray-200 text-gray-700 px-3 py-1 rounded-md">Отмена
                    </button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded-md">Удалить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            // Клик по кнопке удаления
            $('.delete-btn').on('click', function () {
                const productId = $(this).data('id');
                const actionUrl = `/products/${productId}`;
                $('#deleteForm').attr('action', actionUrl);
                $('#deleteModal').removeClass('hidden');
            });

            // Отмена
            $('#cancelDelete').on('click', function () {
                $('#deleteModal').addClass('hidden');
            });

            // Закрытие по клику на фон
            $('#deleteModal').on('click', function (e) {
                if (e.target.id === 'deleteModal') {
                    $('#deleteModal').addClass('hidden');
                }
            });
        });
    </script>
@endsection
