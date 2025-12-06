<x-layouts.app title="Админ панель">
    <h1 class="text-2xl font-bold mb-6">Админ панель</h1>
    <div class="flex gap-4">
        <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">На главную</a>
        <a href="{{ route('cart') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">В корзину</a>
        <div class="flex gap-4">
            <a href="{{ route('admin.products.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Управление товарам</a>
        </div>
    </div>
</x-layouts.app>