<x-layouts.app title="{{ $product->name }}">
    <div class="max-w-4xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.products.index') }}" class="text-blue-600 mb-2 inline-block">
                ← Назад к товарам
            </a>
            <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
        </div>

        <div class="bg-white border rounded p-6">
            <div class="md:grid md:grid-cols-2 md:gap-8">
                <div class="mb-6 md:mb-0">
                    @if($product->image)
                        <img src="{{ asset('storage/products/' . $product->image) }}" 
                             class="w-full rounded border">
                    @else
                        <div class="w-full h-64 bg-gray-100 rounded border flex items-center justify-center">
                            <span class="text-gray-500">Нет изображения</span>
                        </div>
                    @endif
                </div>

                <div>
                    <div class="mb-6">
                        <h2 class="text-xl font-bold">{{ $product->name }}</h2>
                        <p class="text-gray-600 text-sm">ID: {{ $product->id }}</p>
                    </div>

                    <div class="mb-6">
                        <p class="text-3xl font-bold text-blue-600">{{ number_format($product->price, 2) }} ₽</p>
                        <p class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock > 0 ? 'В наличии' : 'Нет в наличии' }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <h3 class="font-bold mb-2">Описание</h3>
                        <p class="text-gray-700">{{ $product->description }}</p>
                    </div>

                    <div class="mb-6 text-sm text-gray-500">
                        <p>Создан: {{ $product->created_at->format('d.m.Y') }}</p>
                        <p>Обновлен: {{ $product->updated_at->format('d.m.Y') }}</p>
                    </div>

                    <div class="flex space-x-3">
                        <a href="{{ route('admin.products.edit', $product) }}"
                           class="bg-black text-white px-4 py-2 rounded">
                            Редактировать
                        </a>
                        <a href="{{ route('admin.products.index') }}"
                           class="bg-gray-200 text-gray-800 px-4 py-2 rounded">
                            Назад
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>