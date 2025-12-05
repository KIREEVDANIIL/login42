<div class="bg-white rounded-lg border border-gray-200 p-6">
    <!-- Сообщения -->
    @session('ok')
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
            {{ session('ok') }}
        </div>
    @endsession
    
    @session('error')
        <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
            {{ session('error') }}
        </div>
    @endsession

    <!-- Форма -->
    <div>
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Добавить категорию</h2>
        
        <form wire:submit="addCategory" class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Название категории
                </label>
                
                <div class="flex gap-4">
                    <div class="flex-1">
                        <input type="text" 
                               id="name" 
                               wire:model="name" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="Введите название">
                        
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" 
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        Сохранить
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>