@extends('app')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Добавить новый продукт</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="productForm" class="space-y-6" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('product.create.information')
            @include('product.create.locations')
            @include('product.create.variation')
            @include('product.create.combo')

            <!-- Загрузка фото -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-medium text-gray-800 mb-4">Фотографии продукта</h3>

                <div class="flex items-center justify-center w-full">
                    <label for="photos"
                           class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                            <p class="text-sm text-gray-500">Перетащите фото или кликните для загрузки</p>
                        </div>
                        <input id="photos" type="file" class="hidden" name="photos[]" multiple accept="image/*">
                    </label>
                </div>

                <div id="previewContainer" class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 hidden">
                    <!-- Преiew загруженных фото -->
                </div>
            </div>

            <!-- Кнопки отправки формы -->
            <div class="border-t border-gray-200 pt-6 flex justify-end space-x-3">
                <button type="button"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                    Отмена
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Создать продукт
                </button>
            </div>
        </form>
        <script>
            $(document).ready(function () {
                const productType = $('#type');
                const variationsSection = $('#variationsSection');
                const comboSection = $('#comboSection');

                productType.on('change', function () {
                    if (this.value === '2') {
                        variationsSection.removeClass('hidden');
                        comboSection.addClass('hidden');
                    } else if (this.value === '3') {
                        variationsSection.addClass('hidden');
                        comboSection.removeClass('hidden');
                    } else {
                        variationsSection.addClass('hidden');
                        comboSection.addClass('hidden');
                    }
                });
                $(function () {
                    $('#addOption').on('click', function () {
                        const optionsContainer = $('#optionsContainer');
                        const optionId = Date.now();

                        const optionHtml = `
                                    <div class="p-4 bg-gray-50 rounded-md" data-option-id="${optionId}">
                                        <div class="flex justify-between items-center mb-3">
                                            <h5 class="font-medium text-gray-700">Опция</h5>
                                            <button type="button" class="text-red-500 hover:text-red-700 remove-option">
                                                 <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                            <x-form.input
                                                name="options[${optionId}][name]"
                                                label="Название опции"
                                                type="text"
                                                required="true"
                                                placeholder="Введите название опции"
                                            />
                                            <x-form.input
                                                name="options[${optionId}][values]"
                                                label="Значения (через запятую)"
                                                type="text"
                                                required="true"
                                                placeholder="Например: Красный, Синий, Зеленый"
                                            />
                                        </div>
                                    </div>
                                `;
                        optionsContainer.append(optionHtml);
                    });

                    // Делегирование событий — удаление опции
                    $('#optionsContainer').on('click', '.remove-option', function () {
                        $(this).closest('[data-option-id]').remove();
                    });
                });

                $(function () {
                    $('#addComponent').on('click', function () {
                        const componentsContainer = $('#componentsContainer');
                        const componentId = Date.now();

                        const componentHtml = `
                                    <div class="p-4 bg-gray-50 rounded-md" data-component-id="${componentId}">
                                        <div class="flex justify-between items-center mb-3">
                                            <h5 class="font-medium text-gray-700">Компонент</h5>
                                            <button type="button" class="text-red-500 hover:text-red-700 remove-component">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <x-form.select
                                                name="components[${componentId}][product]"
                                                label="Продукт"
                                                default-option="Выберите продукт"
                                                :options="$products"
                                                required="true"
                                                id="category"
                                            />
                                            <x-form.input
                                                name="components[${componentId}][quantity]"
                                                label="Количество"
                                                type="number"
                                                required="true"
                                                placeholder="Введите количество"
                                                min="1"
                                                value="1"
                                            />
                                        </div>
                                    </div>
                                `;

                        componentsContainer.append(componentHtml);
                    });

                    // Делегирование событий для удаления компонента
                    $('#componentsContainer').on('click', '.remove-component', function () {
                        $(this).closest('[data-component-id]').remove();
                    });
                });

                $(function () {
                    $('#addLocation').on('click', function () {
                        const locationContainer = $('#locationContainer');
                        const locationId = Date.now();

                        const locationHtml = `
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 rounded-md border-2 bg-slate-50 border-gray-300 border-dashed" data-location-id="${locationId}">
                                <div class="md:col-span-3 font-medium text-gray-700">
                                    <x-form.input
                                        name="locations[${locationId}][name]"
                                        label="Имя локации"
                                        type="text"
                                        required="true"
                                    />
                                </div>
                                <x-form.input
                                    name="locations[${locationId}][sale_price]"
                                    label="Цена продажи"
                                    type="number"
                                    required="true"
                                    min="0"
                                    step="0.01"
                                />
                                <x-form.input
                                    name="locations[${locationId}][purchase_price]"
                                    label="Цена закупки"
                                    type="number"
                                    required="true"
                                    min="0"
                                    step="0.01"
                                />
                                <x-form.input
                                    name="locations[${locationId}][stock]"
                                    label="Запас"
                                    type="number"
                                    required="true"
                                    min="0"
                                />
                                <button type="button" class="remove-location cursor-pointer text-red-500 hover:text-red-700 mt-2 col-span-3">
                                    Удалить локацию
                                </button>
                            </div>
                        `;

                        locationContainer.append(locationHtml);
                    });

                    // Делегирование событий для удаления локации
                    $('#locationContainer').on('click', '.remove-location', function () {
                        $(this).closest('[data-location-id]').remove();
                    });
                });

                $(function () {
                    const photosInput = $('#photos'); // тут исправил id
                    const previewContainer = $('#previewContainer');

                    photosInput.on('change', function (e) {
                        previewContainer.empty().removeClass('hidden');

                        const files = e.target.files;
                        if (!files.length) return;

                        $.each(files, function (i, file) {
                            if (!file.type.match('image.*')) return;

                            const reader = new FileReader();
                            reader.onload = function (e) {
                                const preview = $(`
                    <div class="relative">
                        <img src="${e.target.result}" class="w-full h-24 object-cover rounded-md">
                        <button type="button" class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs remove-photo">
                            &times;
                        </button>
                    </div>
                `);

                                preview.find('.remove-photo').on('click', function () {
                                    preview.remove();
                                    if (previewContainer.children().length === 0) {
                                        previewContainer.addClass('hidden');
                                    }
                                });

                                previewContainer.append(preview);
                            };

                            reader.readAsDataURL(file);
                        });
                    });
                });

                $(function () {
                    const productForm = $('#productForm');
                    const variationsSection = $('#variationsSection');
                    const comboSection = $('#comboSection');
                    const previewContainer = $('#previewContainer');

                    productForm.on('submit', function (e) {
                        e.preventDefault();

                        let isValid = true;

                        // Валидация обязательных полей
                        $(this).find('[required]').each(function () {
                            if (!$(this).val().trim()) {
                                $(this).addClass('border-red-500');
                                isValid = false;
                            } else {
                                $(this).removeClass('border-red-500');
                            }
                        });

                        if (!isValid) {
                            alert('Пожалуйста, заполните все обязательные поля');
                            return;
                        }

                        // Здесь будет код для отправки данных на сервер
                        this.submit();

                        // Сброс формы и скрытие блоков
                        // $(this)[0].reset();
                        // variationsSection.addClass('hidden');
                        // comboSection.addClass('hidden');
                        // previewContainer.addClass('hidden').empty();
                    });
                });

            });
        </script>
    </div>
@endsection
