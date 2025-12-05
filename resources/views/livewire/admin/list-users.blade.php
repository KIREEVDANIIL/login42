<div>
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
        <!-- Заголовок -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Пользователи</h2>
        </div>

        <!-- Контент -->
        <div class="p-6">
            @if(count($users) < 1)
                <div class="text-center py-8 text-gray-500">
                    <p class="text-lg">Пользователей не найдено</p>
                </div>
            @else
                <div class="space-y-3">
                    @foreach ($users as $user)
                        <div id="user-{{ $user->id }}" 
                             class="flex items-center justify-between p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors">
                            
                            <!-- Аватар и информация -->
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/'.$user->avatar) }}" 
                                         alt="{{ $user->name }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                
                                <div>
                                    <h3 class="font-medium text-gray-900">{{ $user->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>

                            <!-- Кнопка удаления -->
                            <button wire:click="deleteUser({{ $user->id }})" 
                                    wire:confirm="Вы уверены, что хотите удалить пользователя?"
                                    class="px-4 py-2 text-sm bg-red-50 text-red-600 hover:bg-red-100 rounded-lg border border-red-200 transition-colors">
                                Удалить
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>