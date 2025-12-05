<div class="space-y-6">
    <!-- Фильтры -->
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <input wire:model.live.debounce.300ms="search"
                   type="text"
                   placeholder="Поиск товаров..."
                   class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">

            <select wire:model.live="category_id" 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Все категории</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <select wire:model.live="country_id" 
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">Все страны</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>

            <button wire:click="resetFilters"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg border border-gray-300 transition-colors">
                Сбросить фильтры
            </button>
        </div>
    </div>

    <!-- Товары -->
    @if ($products->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500">Товары не найдены</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                    <!-- Изображение -->
                    <div class="h-48 bg-gray-100">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Информация -->
                    <div class="p-4">
                        <div class="text-sm text-gray-500 mb-2">
                            @if($product->category)
                                <span class="inline-block px-2 py-1 bg-gray-100 rounded text-xs">
                                    {{ $product->category->name }}
                                </span>
                            @endif
                            @if($product->country)
                                <span class="inline-block px-2 py-1 bg-gray-100 rounded text-xs ml-2">
                                    {{ $product->country->name }}
                                </span>
                            @endif
                        </div>

                        <h3 class="font-medium text-gray-900 mb-2 line-clamp-1">{{ $product->name }}</h3>
                        
                        <div class="mb-3">
                            <span class="text-lg font-semibold text-gray-900">
                                {{ number_format($product->price, 0, '', ' ') }} ₽
                            </span>
                            <span class="text-sm text-gray-500 ml-2">
                                × {{ $product->count }} шт.
                            </span>
                        </div>

                        @if($product->description)
                            <p class="text-sm text-gray-600 line-clamp-2">{{ $product->description }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Пагинация -->
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif
</div>