<!-- Состав комбо (показывается только для комбо продуктов) -->
<div id="comboSection" class="border-t border-gray-200 pt-6 hidden">
    <h3 class="text-lg font-medium text-gray-800 mb-4">Состав комбо</h3>

    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h4 class="font-medium text-gray-700">Компоненты комбо</h4>
            <button type="button" id="addComponent"
                    class="px-3 py-1 bg-blue-100 text-blue-700 text-sm rounded-md hover:bg-blue-200">
                <i class="fas fa-plus mr-1"></i> Добавить компонент
            </button>
        </div>

        <div id="componentsContainer" class="space-y-3">
            <!-- Компоненты будут добавляться динамически -->
        </div>
    </div>
</div>
