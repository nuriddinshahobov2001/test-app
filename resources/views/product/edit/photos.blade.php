<!-- Загрузка фото -->
<div class="border-t border-gray-200 pt-6">
    <h3 class="text-lg font-medium text-gray-800 mb-4">Фотографии продукта</h3>

    <!-- Существующие фотографии -->
    @if($product->photos && count($product->photos) > 0)
        <div class="mb-6">
            <h4 class="text-md font-medium text-gray-700 mb-3">Текущие фотографии</h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($product->photos as $photo)
                    <div class="relative group">
                        <img src="{{ asset('storage/'. $photo->path) }}" alt="Фото продукта"
                             class="w-full h-32 object-cover rounded-md">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity rounded-md">
                            <button type="button" class="text-white p-2 delete-photo"
                                    data-photo-id="{{ $photo->id }}">
                                <i class="fas fa-trash text-xl"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Загрузка новых фото -->
    <div class="flex items-center justify-center w-full">
        <label for="photos"
               class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                <p class="text-sm text-gray-500">Кликните для загрузки новых фото</p>
            </div>
            <input id="photos" type="file" class="hidden" name="photos[]" multiple accept="image/*">
        </label>
    </div>

    <div id="previewContainer" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 hidden">
        <!-- Preview загруженных фото -->
    </div>
</div>
