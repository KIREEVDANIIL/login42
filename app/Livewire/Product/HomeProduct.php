<?php

namespace App\Livewire\Product;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeProduct extends Component
{
    public $products;
    public $search = '';
    public $addedToCart = [];

    public function mount()
    {
        $this->products = Product::all();
    }

    public function addToCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = Product::findOrFail($productId);
        $user = Auth::user();

        // Получаем или создаем корзину пользователя
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Проверяем, есть ли уже этот товар в корзине
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        // Обновляем общую сумму корзины
        $cart->updateTotal();

        // Показываем уведомление
        $this->addedToCart[$productId] = true;
        $this->dispatch('cart-updated');

        session()->flash('success', 'Товар добавлен в корзину!');
    }

    public function searchProducts()
    {
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function render()
    {
        return view('livewire.product.home-product');
    }
}