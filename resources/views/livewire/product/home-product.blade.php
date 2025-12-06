<div>
    <div class="mb-6">
        <input type="text" 
               wire:model.live="search" 
               placeholder="Поиск товаров..." 
               class="w-full p-2 border rounded">
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($products as $product)
            <div class="bg-white border rounded overflow-hidden">
                <div class="h-48 overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/products/' . $product->image) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                        </div>
                    @endif
                </div>
                
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                    
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-xl font-bold text-blue-600">{{ number_format($product->price, 2) }} ₽</span>
                        <span class="text-gray-500 text-sm">Остаток: {{ $product->stock }}</span>
                    </div>

                    <button wire:click="addToCart({{ $product->id }})"
                            class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                        {{ isset($addedToCart[$product->id]) ? '✓ Добавлено' : 'В корзину' }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    @if($products->isEmpty())
        <div class="text-center py-8 text-gray-500">
            Товары не найдены
        </div>
    @endif
</div>