<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/cart', function () {
    return view('cart');
})->name('cart')->middleware('auth');

    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register']);
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });


    Route::middleware('auth')->prefix('orders')->name('orders.')->group(function () {
        Route::get('/my-orders', [OrderController::class, 'index'])->name('index');
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
        Route::post('/orders', [OrderController::class, 'store'])->name('store');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    });


    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
            if (!auth()->user()->is_admin) {
                return redirect()->route('home')->with('error', 'У вас нет прав доступа к админ-панели');
         }
        return view('admin.dashboard');
        })->name('dashboard');
    
        Route::resource('products', ProductController::class);

    
    });