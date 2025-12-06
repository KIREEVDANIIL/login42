<x-layouts.app title="Новый товар">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold mb-2">Новый товар</h1>
        </div>
        <div class="bg-white border rounded p-6">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Название *</label>
                        <input type="text" name="name" required 
                               class="w-full p-2 border rounded"
                               value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Описание *</label>
                        <textarea name="description" required rows="3"
                                  class="w-full p-2 border rounded">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Цена (₽) *</label>
                            <input type="number" name="price" step="0.01" min="0" required 
                                   class="w-full p-2 border rounded"
                                   value="{{ old('price') }}">
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Количество *</label>
                            <input type="number" name="stock" min="0" required 
                                   class="w-full p-2 border rounded"
                                   value="{{ old('stock') }}">
                            @error('stock')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Изображение</label>
                        <input type="file" name="image" class="w-full p-2" accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF. Не более 2MB</p>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex space-x-3 pt-4">
                        <button type="submit" class="bg-black text-white px-4 py-2 rounded">
                            Создать товар
                        </button>
                        <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-800 px-4 py-2 rounded">
                            Отмена
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>