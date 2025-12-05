<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CopyStar' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans text-gray-800 bg-white">
    <!-- Сообщения -->
    @session('ok')
        <div class="bg-green-100 text-green-800 py-3 text-center border-b border-green-200">
            {{ session('ok') }}
        </div>
    @endsession
    
    @session('error')
        <div class="bg-red-100 text-red-800 py-3 text-center border-b border-red-200">
            {{ session('error') }}
        </div>
    @endsession

    <!-- Шапка -->
    <header class="border-b border-gray-200 py-4 bg-white">
        <div class="container mx-auto px-4 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">
                CopyStar
            </a>
            
            <nav class="flex items-center gap-6">
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">
                    Dashboard
                </a>
                <div class="flex gap-2">
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">
                        Register
                    </a>
                    <a href="#" class="px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">
                        Login
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Основной контент -->
    <main class="min-h-[70vh] py-8">
        <div class="container mx-auto px-4">
            {{ $slot }}
        </div>
    </main>

    <!-- Подвал -->
    <footer class="border-t border-gray-200 py-6 mt-8 text-gray-500">
        <div class="container mx-auto px-4 text-center">
            <p>© {{ date('Y') }} CopyStar. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>