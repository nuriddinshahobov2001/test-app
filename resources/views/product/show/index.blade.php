@extends('app')
@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <div class="bg-white rounded-lg overflow-hidden">
            <!-- Заголовок и кнопки действий -->
            <div class="flex justify-between items-center p-6 border-b">
                <h1 class="text-2xl font-bold text-gray-800">Просмотр продукта</h1>
                <div class="flex space-x-3">
                    <a href="{{ route('products.edit', $product->id) }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Редактировать
                    </a>
                    <a href="{{ route('products.index') }}"
                       class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Назад к списку
                    </a>
                </div>
            </div>

            @include('product.show.information')
            @if(!($product->locations)->isEmpty())
                @include('product.show.location')
            @endif

            @if($product->product_type_id == 2)
                @include('product.show.variation')
            @elseif($product->product_type_id == 3)
                @include('product.show.combo')
            @endif
            @if(!($product->photos)->isEmpty())
                @include('product.show.photos')
            @endif

        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Клик по картинке
            $('.group').on('click', function () {
                const imgSrc = $(this).find('img').attr('src');
                $('#modalImage').attr('src', imgSrc);
                $('#imageModal').removeClass('hidden'); // показываем модалку
            });

            // Закрытие по крестику
            $('#closeModal').on('click', function () {
                $('#imageModal').addClass('hidden');
            });

            // Закрытие по клику вне картинки
            $('#imageModal').on('click', function (e) {
                if (e.target.id === 'imageModal') {
                    $('#imageModal').addClass('hidden');
                }
            });

            // Закрытие по Esc
            $(document).on('keydown', function (e) {
                if (e.key === "Escape") {
                    $('#imageModal').addClass('hidden');
                }
            });
        });

    </script>
@endsection
