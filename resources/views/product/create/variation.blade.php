<!-- Валиации (показывается только для продуктов с вариациями) -->

<div id="variationsSection" class="border-t border-gray-200 pt-6 hidden">
    <h3 class="text-lg font-medium text-gray-800 mb-4">Вариации продукта</h3>

    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h4 class="font-medium text-gray-700">Опции продукта</h4>
            <button type="button" id="addOption"
                    class="px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded-md hover:bg-blue-200">
                <i class="fas fa-plus mr-1"></i> Добавить опцию
            </button>
        </div>

        <div id="optionsContainer" class="space-y-3">
            <!-- Опции будут добавляться динамически -->
        </div>
    </div>
</div>
