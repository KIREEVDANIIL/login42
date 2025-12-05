<div>
    <!-- Фильтры -->
    <div class="mb-6">
        <div class="flex flex-wrap gap-3 mb-4">
            <input wire:model.live.debounce.300ms="search"
                   type="text"
                   placeholder="Search products..."
                   class="border rounded px-4 py-2">
            
            <select wire:model.live="category_id" class="border rounded px-4 py-2">
                <option value="">All categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            
            <select wire:model.live="country_id" class="border rounded px-4 py-2">
                <option value="">All countries</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            
            <button wire:click="resetFilters" class="border rounded px-4 py-2 hover:bg-gray-50">
                Reset
            </button>
        </div>
    </div>


    @if($products->isEmpty())
        <div class="text-center p-8 text-gray-500">
            No products found
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($products as $product)
                <div class="border rounded overflow-hidden bg-white">
                   
                    <div class="h-40 bg-gray-100">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    
                    <div class="p-4">
                        <div class="text-sm text-gray-500 mb-1">
                            {{ $product->category?->name ?? 'No category' }}
                        </div>
                        
                        <h3 class="font-medium mb-2">{{ $product->name }}</h3>
                        
                        <div class="flex justify-between items-center">
                            <div class="text-lg font-semibold">
                                ${{ number_format($product->price, 2) }}
                            </div>
                            <div class="text-sm text-gray-500">
                                Stock: {{ $product->count }}
                            </div>
                        </div>
                        
                        @if($product->description)
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2">
                                {{ $product->description }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @endif
</div>