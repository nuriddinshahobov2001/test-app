<!-- Дополнительные фотографии -->
<div class="p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Фотографии продукта</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($product->photos as $photo)
            <div class="relative group">
                <img src="{{ asset('storage/'. $photo->path) }}" alt="Пицца Маргарита" class="w-full h-40 object-cover rounded-md">
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity rounded-md">
                    <button class="text-white p-2">
                        <i class="fas fa-search-plus text-xl"></i>
                    </button>
                </div>
            </div>
        @endforeach
            <!-- Модальное окно -->
            <div id="imageModal" class="fixed inset-0 bg-black/40  flex items-center justify-center hidden z-50">
                <span id="closeModal" class="absolute top-5 right-8 text-white text-4xl cursor-pointer">&times;</span>
                <img id="modalImage" src="" class="max-h-[90%] max-w-[90%] rounded shadow-lg">
            </div>
    </div>
</div>
