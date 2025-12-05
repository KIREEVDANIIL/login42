<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-50">
    
    <div class="min-h-screen flex flex-col">
        <header class="bg-white shadow-sm">
            <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                <div class="flex items-center gap-6">
                    <h1 class="text-lg font-bold text-blue-600">Admin Panel</h1>
                    <nav class="flex gap-4">
                        <a href="{{ route('dashboard.category') }}" class="text-gray-600 hover:text-gray-900">
                            Categories
                        </a>
                        <a href="{{ route('dashboard.product') }}" class="text-gray-600 hover:text-gray-900">
                            Products
                        </a>
                        <a href="{{ route('dashboard.user') }}" class="text-gray-600 hover:text-gray-900">
                            Users
                        </a>
                    </nav>
                </div>
                
                <div class="flex gap-4">
                    <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-700">
                        ← Back to site
                    </a>
                </div>
            </div>
        </header>

        <main class="flex-1 container mx-auto px-4 py-6">
            @isset($breadcrumbs)
                <div class="mb-4 text-sm text-gray-500">
                    {{ $breadcrumbs }}
                </div>
            @endisset

            @if(session('status'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>