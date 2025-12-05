<div class="space-y-6">
    <!-- Заголовок и поиск -->
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-900">Товары</h2>
        
        <div class="w-64">
            <input wire:model.live.debounce.300ms="search" 
                   type="text" 
                   placeholder="Поиск товаров..." 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
    </div>

    <!-- Фильтры -->
    <div class="flex flex-wrap gap-4">
        <select wire:model.live="category_id" 
                class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">Все категории</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <select wire:model.live="country_id" 
                class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">Все страны</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>

        <button wire:click="resetFilters" 
                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg border border-gray-300 text-sm transition-colors">
            Сбросить фильтры
        </button>
    </div>

    <!-- Таблица -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        @if ($products->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500">Товары не найдены</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th wire:click='sortBy("id")' 
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                ID
                            </th>
                            <th wire:click='sortBy("name")' 
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Название
                            </th>
                            <th wire:click='sortBy("price")' 
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Цена
                            </th>
                            <th wire:click='sortBy("count")' 
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Кол-во
                            </th>
                            <th wire:click='sortBy("category_id")' 
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Категория
                            </th>
                            <th wire:click='sortBy("country_id")' 
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                Страна
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Действия
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $product->id }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $product->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ number_format($product->price, 0, '', ' ') }} ₽
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $product->count }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $product->category?->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $product->country?->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button wire:click="deleteProduct({{ $product->id }})"
                                            wire:confirm="Удалить товар?"
                                            class="px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg border border-red-200 text-sm transition-colors">
                                        Удалить
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Пагинация -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>