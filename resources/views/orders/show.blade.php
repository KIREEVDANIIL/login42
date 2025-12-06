<x-layouts.app title="Заказ #{{ $order->order_number }}">
    <div class="max-w-6xl mx-auto">
        <!-- Навигация -->
        <div class="mb-6">
            <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800 hover:underline flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Назад к списку заказов
            </a>
        </div>

        <!-- Уведомления -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Заголовок заказа -->
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Заказ #{{ $order->order_number }}</h1>
                    <p class="text-gray-600 mt-2">
                        <span class="font-medium">Дата оформления:</span> 
                        {{ $order->created_at->format('d.m.Y в H:i') }}
                    </p>
                </div>
                <div>
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $order->status_class }}">
                        {{ $order->status_label }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Товары заказа -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 pb-4 border-b">Состав заказа</h2>
                    
                    <div class="space-y-4">
                        @forelse($order->items as $item)
                            <div class="flex flex-col sm:flex-row items-start sm:items-center border-b pb-4 last:border-b-0">
                                <!-- Изображение товара -->
                                <div class="w-20 h-20 bg-gray-100 rounded-lg flex items-center justify-center mb-3 sm:mb-0 sm:mr-4 flex-shrink-0">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                             alt="{{ $item->product_name }}"
                                             class="w-full h-full object-cover rounded-lg">
                                    @else
                                        <svg class="w-10 h-10 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </div>
                                
                                <!-- Информация о товаре -->
                                <div class="flex-1">
                                    <h3 class="font-bold text-gray-900">{{ $item->product_name }}</h3>
                                    @if($item->product_description)
                                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $item->product_description }}</p>
                                    @endif
                                    <div class="mt-2 text-gray-700">
                                        <span>{{ $item->quantity }} шт. × {{ number_format($item->price, 2) }} ₽</span>
                                    </div>
                                </div>
                                
                                <!-- Сумма за позицию -->
                                <div class="mt-3 sm:mt-0 sm:ml-4">
                                    <div class="font-bold text-lg whitespace-nowrap">
                                        {{ number_format($item->price * $item->quantity, 2) }} ₽
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                                <p>В заказе нет товаров</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Итоги -->
                    <div class="mt-8 pt-6 border-t">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Стоимость товаров:</span>
                                <span class="font-medium">{{ number_format($order->total_amount, 2) }} ₽</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Стоимость доставки:</span>
                                <span class="text-green-600 font-medium">Бесплатно</span>
                            </div>
                            <div class="flex justify-between text-xl font-bold pt-4 border-t">
                                <span>Итого к оплате:</span>
                                <span class="text-blue-600">{{ number_format($order->total_amount, 2) }} ₽</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Панель с информацией и действиями -->
            <div class="space-y-6">
                <!-- Информация о доставке -->
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Информация о доставке</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <h3 class="font-medium text-gray-700 mb-1 text-sm">Адрес доставки:</h3>
                            <p class="text-gray-900">{{ $order->shipping_address }}</p>
                        </div>
                        
                        @if($order->billing_address && $order->billing_address !== $order->shipping_address)
                            <div>
                                <h3 class="font-medium text-gray-700 mb-1 text-sm">Платежный адрес:</h3>
                                <p class="text-gray-900">{{ $order->billing_address }}</p>
                            </div>
                        @endif
                        
                        <div>
                            <h3 class="font-medium text-gray-700 mb-1 text-sm">Телефон для связи:</h3>
                            <p class="text-gray-900">{{ $order->phone }}</p>
                        </div>
                        
                        @if($order->notes)
                            <div>
                                <h3 class="font-medium text-gray-700 mb-1 text-sm">Комментарий:</h3>
                                <p class="text-gray-900">{{ $order->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Действия с заказом -->
                <div class="bg-white rounded-lg shadow-sm border p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Действия</h2>
                    
                    <div class="space-y-3">
                        <a href="{{ route('home') }}"
                           class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-300">
                            Продолжить покупки
                        </a>
                        
                        @if($order->isPending() || $order->isProcessing())
                            <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        onclick="return confirm('Вы уверены, что хотите отменить этот заказ?')"
                                        class="block w-full bg-white text-red-600 border border-red-600 text-center py-3 rounded-lg font-medium hover:bg-red-50 transition duration-300">
                                    Отменить заказ
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('orders.index') }}"
                           class="block w-full bg-gray-100 text-gray-700 text-center py-3 rounded-lg font-medium hover:bg-gray-200 transition duration-300">
                            Все мои заказы
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>