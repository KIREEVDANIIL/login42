<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'CopyStar' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-50">
    
    @if(session('success'))
        <div class="bg-green-100 p-3 text-center text-green-700">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 p-3 text-center text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <header class="bg-white shadow-sm mb-6">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">
                CopyStar
            </a>
            
            <div class="flex gap-4">
                <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">
                    Dashboard
                </a>
                @auth
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="" class="text-gray-600 hover:text-gray-900">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>