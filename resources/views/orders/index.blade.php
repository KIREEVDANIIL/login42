<x-layouts.app title="Мои заказы">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Мои заказы</h1>

        @if($orders->isEmpty())
            <div class="bg-white border rounded-xl p-8 text-center shadow-sm">
                <div class="text-gray-300 mb-4">
                    <svg class="w-20 h-20 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2">У вас пока нет заказов</h3>
                <p class="text-gray-600 mb-6">Сделайте свой первый заказ!</p>
                <a href="{{ route('home') }}" 
                   class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                    Перейти к покупкам
                </a>
            </div>
        @else
            <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left p-4 font-semibold text-gray-700">Номер заказа</th>
                                <th class="text-left p-4 font-semibold text-gray-700">Дата</th>
                                <th class="text-left p-4 font-semibold text-gray-700">Сумма</th>
                                <th class="text-left p-4 font-semibold text-gray-700">Статус</th>
                                <th class="text-left p-4 font-semibold text-gray-700">Действия</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($orders as $order)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="p-4 font-medium text-gray-900">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="p-4 text-gray-700">
                                        {{ $order->created_at->format('d.m.Y H:i') }}
                                    </td>
                                    <td class="p-4 font-medium text-gray-900">
                                        {{ number_format($order->total_amount, 2) }} ₽
                                    </td>
                                    <td class="p-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $order->status_class }}">
                                            {{ $order->status_label }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <a href="{{ route('orders.show', $order->id) }}"
                                           class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                                            Подробнее
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>