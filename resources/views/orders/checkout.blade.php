<x-layouts.app title="Оформление заказа">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Навигация -->
        <div class="mb-6">
            <a href="{{ route('cart') }}" class="text-blue-500 hover:text-blue-600">
                ← Вернуться в корзину
            </a>
        </div>

        <h1 class="text-2xl font-bold text-gray-900 mb-6">Оформление заказа</h1>

        @if($cartItems && $cartItems->count() > 0)
        <div class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg border p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Данные для доставки</h2>

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Адрес доставки *
                                </label>
                                <textarea name="shipping_address" required rows="3"
                                          class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Улица, дом, квартира, город">{{ old('shipping_address') }}</textarea>
                                @error('shipping_address')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Телефон -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Телефон *
                                </label>
                                <input type="tel" name="phone" required
                                       class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="+7 (999) 999-99-99"
                                       value="{{ old('phone') }}">
                                @error('phone')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Комментарий к заказу
                                </label>
                                <textarea name="notes" rows="2"
                                          class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Дополнительные пожелания">{{ old('notes') }}</textarea>
                                @error('notes')
                                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>


            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg border p-6 sticky top-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Ваш заказ</h3>

                    <div class="space-y-3 mb-4 max-h-64 overflow-y-auto pr-2">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between border-b pb-3">
                                <div class="flex-1">
                                    <p class="font-medium">{{ $item->product->name }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ $item->quantity }} × {{ number_format($item->price, 2) }} ₽
                                    </p>
                                </div>
                                <div class="font-bold whitespace-nowrap">
                                    {{ number_format($item->price * $item->quantity, 2) }} ₽
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-3 border-t pt-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Товары ({{ $cartItems->sum('quantity') }}):</span>
                            <span class="font-medium">{{ number_format($total, 2) }} ₽</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Доставка:</span>
                            <span class="text-green-600 font-medium">Бесплатно</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold border-t pt-4">
                            <span>Итого к оплате:</span>
                            <span class="text-blue-600">{{ number_format($total, 2) }} ₽</span>
                        </div>
                    </div>

                    <button type="submit" form="orderForm" class="mt-6 w-full px-4 py-3 bg-blue-500 text-white rounded-lg font-bold hover:bg-blue-600">
                        Подтвердить заказ
                    </button>

                    <form id="orderForm" action="{{ route('orders.store') }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" name="shipping_address" id="shippingAddressInput">
                        <input type="hidden" name="phone" id="phoneInput">
                        <input type="hidden" name="notes" id="notesInput">
                        <input type="hidden" name="total_amount" value="{{ $total }}">
                    </form>
                </div>
            </div>
        </div>
        @else
            <div class="text-center py-8">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Корзина пуста</h3>
                <p class="text-gray-600 mb-4">Добавьте товары в корзину для оформления заказа</p>
                <a href="{{ route('home') }}" class="text-blue-500 hover:text-blue-600">
                    Перейти к покупкам →
                </a>
            </div>
        @endif
    </div>
</x-layouts.app>