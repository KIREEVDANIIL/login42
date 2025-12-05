<div class="space-y-6">
    <!-- Сообщения -->
    @session('ok')
        <div class="p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
            {{ session('ok') }}
        </div>
    @endsession
    
    @session('error')
        <div class="p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
            {{ session('error') }}
        </div>
    @endsession

    <!-- Кнопка добавления -->
    <div>
        <button wire:click='toggleActive' 
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Добавить страну
        </button>
    </div>

    <!-- Форма добавления (если активно) -->
    @if ($is_active)
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Добавить страну</h2>
            
            <form wire:submit="addCountry" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Название страны
                    </label>
                    
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <input type="text" 
                                   id="name" 
                                   wire:model="name"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="Введите название страны">
                            
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
    @endif
</div>