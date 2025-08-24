<div class="border-t border-gray-200 pt-6">
    <h3 class="text-lg font-medium text-gray-800 mb-4">Фотографии продукта</h3>

    <!-- Существующие фотографии в виде таблицы -->
        <div class="mb-6">
            <h4 class="text-md font-medium text-gray-700 mb-3">Текущие фотографии</h4>

            <!-- Таблица с фотографиями -->
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Фотография
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Название
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Размер
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <input id="select-all-photos" type="checkbox" class="h-4 w-4 text-blue-600 rounded">
                                <label for="select-all-photos" class="ml-2">Удалить</label>
                            </div>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($product->photos as $photo)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ asset('storage/'. $photo->path) }}" alt="Фото продукта"
                                     class="w-16 h-16 object-cover rounded-md">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ basename($photo->path) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ round(filesize(storage_path('app/public/'. $photo->path)) / 1024) }} KB
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <input type="checkbox" name="photos_to_delete[]" value="{{ $photo->id }}"
                                       class="h-4 w-4 text-blue-600 rounded photo-checkbox">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

{{--            <!-- Кнопка удаления выбранных фото -->--}}
{{--            <div class="mt-4 flex justify-end">--}}
{{--                <button type="button" id="delete-selected-photos"--}}
{{--                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 opacity-50 cursor-not-allowed"--}}
{{--                        disabled>--}}
{{--                    <i class="fas fa-trash mr-2"></i> Удалить выбранные--}}
{{--                </button>--}}
{{--            </div>--}}
        </div>

    <!-- Загрузка новых фото -->
    <div class="mt-8">
        <h4 class="text-md font-medium text-gray-700 mb-3">Добавить новые фотографии</h4>
        <div class="flex items-center justify-center w-full">
            <label for="photos"
                   class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                    <p class="text-sm text-gray-500">Кликните для загрузки новых фото</p>
                    <p class="text-xs text-gray-400 mt-1">Максимум 10 файлов (JPG, PNG)</p>
                </div>
                <input id="photos" type="file" class="hidden" name="photos[]" multiple accept="image/jpeg,image/png">
            </label>
        </div>

        <div id="previewContainer" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 hidden">
            <!-- Preview загруженных фото -->
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Выбор всех фотографий
        const selectAll = document.getElementById('select-all-photos');
        const checkboxes = document.querySelectorAll('.photo-checkbox');
        // const deleteButton = document.getElementById('delete-selected-photos');

        if (selectAll) {
            selectAll.addEventListener('change', function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAll.checked;
                });
            });
        }

        // Обновление состояния кнопки удаления
        function updateDeleteButtonState() {
             Array.from(checkboxes).some(checkbox => checkbox.checked);
        }

        // Слушатели изменений для чекбоксов
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButtonState);
        });

        // Предварительный просмотр загружаемых фото
        const photoInput = document.getElementById('photos');
        const previewContainer = document.getElementById('previewContainer');

        if (photoInput && previewContainer) {
            photoInput.addEventListener('change', function(event) {
                previewContainer.innerHTML = '';
                previewContainer.classList.add('hidden');

                if (this.files && this.files.length > 0) {
                    previewContainer.classList.remove('hidden');

                    Array.from(this.files).forEach(file => {
                        if (file.type.match('image.*')) {
                            const reader = new FileReader();
                            const div = document.createElement('div');
                            div.className = 'relative group';

                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = 'w-full h-32 object-cover rounded-md';
                                div.appendChild(img);

                                const nameDiv = document.createElement('div');
                                nameDiv.className = 'text-xs text-gray-500 truncate mt-1';
                                nameDiv.textContent = file.name;
                                div.appendChild(nameDiv);
                            };

                            reader.readAsDataURL(file);
                            previewContainer.appendChild(div);
                        }
                    });
                }
            });
        }
    });
</script>
