<div>
    <h2 class="text-xl font-bold mb-4">Ваша корзина</h2>
    @if($cartItems && $cartItems->count() > 0)
        <div class="space-y-4">
            @foreach($cartItems as $item)
                <div class="flex border-b pb-4">
                    <div class="w-16 h-16 bg-gray-200 rounded mr-4 flex items-center justify-center">

                    </div>
                    
                    <div class="flex-grow">
                        <h4 class="font-bold">{{ $item->product->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $item->product->description }}</p>
                        
                        <div class="flex items-center mt-2">
                            <div class="flex items-center border rounded">
                                <button wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                        class="w-8 h-8 flex items-center justify-center hover:bg-gray-100">
                                    -
                                </button>
                                <span class="w-10 text-center">{{ $item->quantity }}</span>
                                <button wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                        class="w-8 h-8 flex items-center justify-center hover:bg-gray-100">
                                    +
                                </button>
                            </div>

                            <div class="ml-6">
                                <div class="font-bold">{{ number_format($item->price * $item->quantity, 2) }} ₽</div>
                                <div class="text-sm text-gray-500">{{ number_format($item->price, 2) }} ₽/шт</div>
                            </div>
                        </div>
                    </div>
                    
                    <button wire:click="removeItem({{ $item->id }})"
                            class="text-red-500 hover:text-red-700 ml-4">
                        ✕
                    </button>
                </div>
            @endforeach
        </div>

<button onclick="window.location.href='{{ route('orders.checkout') }}'"
        class="px-8 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors duration-200 flex items-center space-x-2">
    <span>Оформить заказ</span>
</button>
    @else
        <div class="text-center py-8">
            <div class="text-gray-400 mb-4">
                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h3 class="text-lg font-bold mb-2">Корзина пуста</h3>
            <p class="text-gray-600 mb-4">Добавьте товары из каталога</p>
            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
                Перейти к покупкам →
            </a>
        </div>
    @endif
</div>