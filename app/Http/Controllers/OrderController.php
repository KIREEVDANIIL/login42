<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;

class OrderController extends Controller
{
    /**
     * Показать страницу оформления заказа
     */
    public function checkout()
    {
        // Проверяем аутентификацию
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Получаем текущую корзину пользователя
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Ваша корзина пуста');
        }

        // Получаем товары в корзине
        $cartItems = CartItem::with('product')
            ->where('cart_id', $cart->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Ваша корзина пуста');
        }

        // Вычисляем общую сумму
        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('orders.checkout', [
            'cartItems' => $cartItems,
            'total' => $total,
            'itemsCount' => $cartItems->count()
        ]);
    }

    /**
     * Создать заказ
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Проверяем корзину
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Ваша корзина пуста');
        }

        $cartItems = CartItem::with('product')
            ->where('cart_id', $cart->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Ваша корзина пуста');
        }

        // Вычисляем сумму
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        try {
            // Создаем заказ
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'billing_address' => $request->shipping_address,
                'phone' => $request->phone,
                'notes' => $request->notes,
            ]);

            // Создаем позиции заказа
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                    'product_name' => $cartItem->product->name,
                    'product_description' => $cartItem->product->description ?? '',
                ]);
            }

            // Очищаем корзину
            CartItem::where('cart_id', $cart->id)->delete();
            $cart->delete();

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Заказ оформлен! Номер: ' . $order->order_number);

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ошибка при оформлении заказа: ' . $e->getMessage());
        }
    }

    /**
     * Показать детали заказа
     */
    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $order = Order::with('items.product')->find($id);
        
        if (!$order) {
            return redirect()->route('orders.index')
                ->with('error', 'Заказ не найден');
        }

        // Проверяем, принадлежит ли заказ текущему пользователю
        if ($order->user_id !== Auth::id()) {
            abort(403, 'У вас нет доступа к этому заказу');
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Список заказов пользователя
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Отменить заказ (для пользователя)
     */
    public function cancel($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $order = Order::find($id);
        
        if (!$order) {
            return redirect()->route('orders.index')
                ->with('error', 'Заказ не найден');
        }

        // Проверяем, принадлежит ли заказ текущему пользователю
        if ($order->user_id !== Auth::id()) {
            abort(403, 'У вас нет доступа к этому заказу');
        }

        // Можно отменять только заказы в статусе pending
        if ($order->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Можно отменять только заказы в статусе "Ожидает"');
        }

        // Обновляем статус
        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Заказ успешно отменен');
    }

    // ... остальные методы для админа ...
}