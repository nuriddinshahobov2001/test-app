<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Название -->
    <x-form.input
        name="name"
        label="Название продукта"
        type="text"
        required="true"
        placeholder="Введите название продукта"
    />

    <!-- Тип продукта -->
    <x-form.select
        name="product_type_id"
        label="Тип продукт"
        default-option="Выберите продукта"
        :options="$productTypes"
        required="true"
        id="type"
    />

    <!-- Бренд -->
    <x-form.select
        name="brand_id"
        label="Бренд"
        default-option="Выберите бренд"
        :options="$brands"
        required="true"
        id="brand"
    />

    <!-- Категория -->
    <x-form.select
        name="category_id"
        label="Категория"
        default-option="Выберите категория"
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
        required="true"
        id="currency"
    />

</div>
