<div>
    <!-- Поиск и фильтры -->
    <div class="mb-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Products</h2>
            
            <input wire:model.live.debounce.300ms="search" 
                   type="text" 
                   placeholder="Search products..."
                   class="border rounded px-3 py-1">
        </div>
        
        <div class="flex gap-3 mb-4">
            <select wire:model.live="category_id" class="border rounded px-3 py-1">
                <option value="">All categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            
            <select wire:model.live="country_id" class="border rounded px-3 py-1">
                <option value="">All countries</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            
            <button wire:click="resetFilters" class="border rounded px-3 py-1 hover:bg-gray-50">
                Reset
            </button>
        </div>
    </div>

    <!-- Таблица -->
    @if($products->isEmpty())
        <div class="text-center p-8 text-gray-500 border rounded">
            No products found
        </div>
    @else
        <div class="overflow-x-auto border rounded">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left p-3 border-b text-sm">ID</th>
                        <th class="text-left p-3 border-b text-sm">Name</th>
                        <th class="text-left p-3 border-b text-sm">Price</th>
                        <th class="text-left p-3 border-b text-sm">Stock</th>
                        <th class="text-left p-3 border-b text-sm">Category</th>
                        <th class="text-left p-3 border-b text-sm">Country</th>
                        <th class="text-left p-3 border-b text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $product->id }}</td>
                            <td class="p-3">{{ $product->name }}</td>
                            <td class="p-3">${{ number_format($product->price, 2) }}</td>
                            <td class="p-3">{{ $product->count }}</td>
                            <td class="p-3">{{ $product->category?->name ?? '-' }}</td>
                            <td class="p-3">{{ $product->country?->name ?? '-' }}</td>
                            <td class="p-3">
                                <button wire:click="deleteProduct({{ $product->id }})"
                                        wire:confirm="Delete product?"
                                        class="text-red-600 hover:text-red-800 text-sm">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Пагинация -->
            @if($products->hasPages())
                <div class="p-3 border-t">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    @endif
</div>