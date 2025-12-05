<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Админ панель' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-700">
    <div class="flex min-h-screen">
        <!-- Боковое меню -->
        <aside class="w-64 bg-white border-r border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-indigo-600">Админ панель</h2>
            </div>
            
            <nav class="p-4 space-y-1">
                <a href="{{ route('dashboard.category') }}" 
                   class="block px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded">
                    Категории
                </a>
                <a href="{{ route('dashboard.country') }}" 
                   class="block px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded">
                    Страны
                </a>
                <a href="{{ route('dashboard.user') }}" 
                   class="block px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded">
                    Пользователи
                </a>
                <a href="{{ route('dashboard.product') }}" 
                   class="block px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded">
                    Продукты
                </a>
            </nav>
        </aside>

        <!-- Основная часть -->
        <div class="flex-1 flex flex-col">
            <!-- Верхняя панель -->
            <header class="bg-white border-b border-gray-200 px-6 py-4">
                <div class="flex justify-between items-center">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">
                        ← На главную
                    </a>
                    <span class="text-gray-400 text-sm">
                        {{ date('d.m.Y') }}
                    </span>
                </div>
            </header>

            <!-- Контент -->
            <main class="flex-1 p-6">
                <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                    {{ $slot }}
                </div>
            </main>

            <!-- Подвал -->
            <footer class="bg-white border-t border-gray-200 px-6 py-4 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Админ панель
            </footer>
        </div>
    </div>
</body>
</html>