<x-layouts.app title="Товары">
    <div class="mb-6">
        <h1 class="text-2xl font-bold mb-2">Товары</h1>
        <p class="text-gray-600 mb-4">Управление товарами магазина</p>
        <a href="{{ route('admin.products.create') }}" 
           class="inline-block bg-black text-white px-4 py-2 rounded">
            + Добавить товар
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border rounded">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-3 text-left">ID</th>
                    <th class="p-3 text-left">Название</th>
                    <th class="p-3 text-left">Цена</th>
                    <th class="p-3 text-left">Остаток</th>
                    <th class="p-3 text-left">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr class="border-t">
                        <td class="p-3">{{ $product->id }}</td>
                        <td class="p-3">
                            <div class="flex items-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/products/' . $product->image) }}" 
                                         class="w-10 h-10 rounded mr-3">
                                @endif
                                <span>{{ $product->name }}</span>
                            </div>
                        </td>
                        <td class="p-3">{{ number_format($product->price, 2) }} ₽</td>
                        <td class="p-3">
                            <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock }} шт.
                            </span>
                        </td>
                        <td class="p-3">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="bg-black text-white px-3 py-1 text-sm rounded">
                                    Изменить
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Удалить товар?')"
                                            class="bg-red-600 text-white px-3 py-1 text-sm rounded">
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @endif
</x-layouts.app>