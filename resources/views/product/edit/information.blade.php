<div class="border-b border-gray-200 pb-6">
    <h3 class="text-lg font-medium text-gray-800 mb-4">Основная информация</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Название -->
        <x-form.input
            name="name"
            label="Название продукта"
            type="text"
            required="true"
            placeholder="Введите название продукта"
            :value="$product->name"
        />

        <!-- Тип продукта -->
        <x-form.select
            name="product_type_id"
            label="Тип продукт"
            default-option="Выберите продукта"
            :options="$productTypes"
            required="true"
            :selected="$product->product_type_id"
            id="type"
        />

        <!-- Бренд -->
        <x-form.select
            name="brand_id"
            label="Бренд"
            default-option="Выберите бренд"
            :options="$brands"
            required="true"
            :selected="$product->brand_id"
            id="brand"
        />

        <!-- Категория -->
        <x-form.select
            name="category_id"
            label="Категория"
            default-option="Выберите категория"
            :selected="$product->category_id"
            :options="$categories"
            required="true"
            id="category"
        />

        <!-- Валюта -->
        <x-form.select
            name="currency_id"
            label="Валюта"
            default-option="Выберите валюту"
            :options="$currencies"
            :selected="$product->currency_id"
            required="true"
            id="currency"
        />

    </div>
</div>
