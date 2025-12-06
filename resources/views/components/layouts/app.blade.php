<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Магазин' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow mb-4">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-3">
                <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">Shop</a>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">Товары</a>
                    <a href="{{ route('cart') }}" class="text-gray-700 hover:text-blue-600">Корзина</a>
                    @auth
                        <a href="{{ route('orders.index') }}" class="text-gray-700 hover:text-blue-600">Заказы</a>
                        <span class="text-gray-700">{{ Auth::user()->name }}</span>

                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:text-red-800">Админ</a>
                        @endif
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-blue-600">Выйти</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Войти</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-3 py-1 rounded">Регистрация</a>
                    @endauth
                    
                </div>
            </div>
        </div>
    </nav>
    @if(session('success'))
        <div class="container mx-auto px-4 mb-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif
    
    @if(session('error'))
        <div class="container mx-auto px-4 mb-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <main class="container mx-auto px-4 py-4">
        {{ $slot }}
    </main>
</body>
</html>