<?php

namespace App\Livewire\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartComponent extends Component
{
    public $cartItems = [];
    public $total = 0;
    public $itemCount = 0;

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (Auth::check()) {
            $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();
            
            if ($cart) {
                // Не преобразуем в массив, оставляем коллекцию
                $this->cartItems = $cart->items;
                $this->total = $cart->total_amount;
                $this->itemCount = $cart->items->count();
            }
        }
        
        // Отправляем данные в родительское представление
        $this->dispatch('cart-updated', [
            'itemCount' => $this->itemCount,
            'total' => $this->total
        ]);
    }

    public function updateQuantity($itemId, $quantity)
    {
        if ($quantity < 1) {
            $this->removeItem($itemId);
            return;
        }

        $cartItem = CartItem::find($itemId);
        if ($cartItem && $cartItem->cart->user_id == Auth::id()) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
            
            $cartItem->cart->updateTotal();
            $this->loadCart();
            
            $this->dispatch('cart-updated', [
                'itemCount' => $this->itemCount,
                'total' => $this->total
            ]);
        }
    }

    public function removeItem($itemId)
    {
        $cartItem = CartItem::find($itemId);
        if ($cartItem && $cartItem->cart->user_id == Auth::id()) {
            $cartItem->delete();
            
            $cartItem->cart->updateTotal();
            $this->loadCart();
            
            $this->dispatch('cart-updated', [
                'itemCount' => $this->itemCount,
                'total' => $this->total
            ]);
            
            session()->flash('success', 'Товар удален из корзины');
        }
    }

    public function clearCart()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->items()->delete();
            $cart->updateTotal();
            $this->loadCart();
            
            $this->dispatch('cart-updated', [
                'itemCount' => $this->itemCount,
                'total' => $this->total
            ]);
            
            session()->flash('success', 'Корзина очищена');
        }
    }

    public function checkout()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        
        if (!$cart || $cart->items->isEmpty()) {
            session()->flash('error', 'Корзина пуста');
            return;
        }

        // Здесь можно добавить логику оформления заказа
        session()->flash('success', 'Заказ успешно оформлен!');
        
        // Очищаем корзину после оформления
        $cart->items()->delete();
        $cart->updateTotal();
        $this->loadCart();
        
        $this->dispatch('cart-updated', [
            'itemCount' => $this->itemCount,
            'total' => $this->total
        ]);
    }
    
    public function getCartData()
    {
        $this->dispatch('cart-updated', [
            'itemCount' => $this->itemCount,
            'total' => $this->total
        ]);
    }

    public function render()
    {
        return view('livewire.cart.cart-component');
    }
}