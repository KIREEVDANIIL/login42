<div class="space-y-6">
    <!-- Кнопка добавления -->
    <button wire:click="toggleForm"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Добавить товар
    </button>

    <!-- Форма -->
    @if ($is_active)
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Новый товар</h2>
            
            <form wire:submit.prevent="save" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Название -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Название</label>
                        <input type="text" wire:model="name" id="name"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('name') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Цена -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Цена (₽)</label>
                        <input type="number" wire:model="price" id="price" min="0" step="1"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('price') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        @if($price)
                            <p class="mt-2 text-sm text-gray-500">{{ number_format($price, 0, '', ' ') }} рублей</p>
                        @endif
                    </div>

                    <!-- Количество -->
                    <div>
                        <label for="count" class="block text-sm font-medium text-gray-700 mb-2">Количество</label>
                        <input type="number" wire:model="count" id="count" min="0"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('count') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Категория -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Категория</label>
                        <select wire:model="category_id" id="category_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Выберите категорию</option>
                            @foreach($this->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Страна -->
                    <div>
                        <label for="country_id" class="block text-sm font-medium text-gray-700 mb-2">Страна</label>
                        <select wire:model="country_id" id="country_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Выберите страну</option>
                            @foreach($this->countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Статус -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Статус</label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" wire:model="is_active"
                                   class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span>Активный</span>
                        </label>
                    </div>

                    <!-- Изображение -->
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Изображение</label>
                        <input type="file" wire:model="image" id="image" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        @error('image') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        
                        @if ($image)
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 mb-2">Предпросмотр:</p>
                                <img src="{{ $image->temporaryUrl() }}" 
                                     class="w-40 h-40 object-cover rounded-lg border border-gray-300">
                            </div>
                        @endif
                    </div>

                    <!-- Описание -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Описание</label>
                        <textarea wire:model="description" id="description" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                        @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <!-- Кнопки -->
                    <div class="md:col-span-2 flex justify-end gap-4 pt-4">
                        <button type="button" wire:click="toggleForm"
                                class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Отмена
                        </button>
                        <button type="submit"
                                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            Сохранить товар
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif
</div>