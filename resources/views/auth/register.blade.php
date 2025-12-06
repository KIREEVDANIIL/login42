<x-layouts.app title="Регистрация">
    <div class="max-w-md mx-auto">
        <div class="bg-white border rounded p-6">
            <h2 class="text-2xl font-bold mb-6 text-center">Регистрация</h2>
            
            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Имя</label>
                    <input type="text" name="name" required
                           class="w-full p-2 border rounded"
                           placeholder="Ваше имя">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" required
                           class="w-full p-2 border rounded"
                           placeholder="email@example.com">
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Пароль</label>
                    <input type="password" name="password" required
                           class="w-full p-2 border rounded"
                           placeholder="Пароль">
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Подтвердите пароль</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full p-2 border rounded"
                           placeholder="Повторите пароль">
                </div>
                
                <div class="mb-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="terms" required class="mr-2">
                        <span class="text-gray-700">Согласен с условиями</span>
                    </label>
                </div>
                
                <button type="submit"
                        class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                    Зарегистрироваться
                </button>
                
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                        Уже есть аккаунт? Войти
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>