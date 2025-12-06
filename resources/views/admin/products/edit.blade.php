<x-layouts.app title="Изменить товар">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold mb-2">Изменить товар</h1>
            <p class="text-gray-600">{{ $product->name }}</p>
        </div>

        <div class="bg-white border rounded p-6">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                @if($product->image)
                    <div class="mb-4">
                        <p class="text-sm text-gray-700 mb-2">Текущее изображение:</p>
                        <img src="{{ asset('storage/products/' . $product->image) }}" 
                             class="w-32 h-32 rounded border">
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Название *</label>
                        <input type="text" name="name" required 
                               class="w-full p-2 border rounded"
                               value="{{ old('name', $product->name) }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Описание *</label>
                        <textarea name="description" required rows="3"
                                  class="w-full p-2 border rounded">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 mb-2">Цена (₽) *</label>
                            <input type="number" name="price" step="0.01" min="0" required 
                                   class="w-full p-2 border rounded"
                                   value="{{ old('price', $product->price) }}">
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 mb-2">Количество *</label>
                            <input type="number" name="stock" min="0" required 
                                   class="w-full p-2 border rounded"
                                   value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Новое изображение</label>
                        <input type="file" name="image" class="w-full p-2" accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">Оставьте пустым, чтобы не менять</p>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex space-x-3 pt-4">
                        <button type="submit" class="bg-black text-white px-4 py-2 rounded">
                            Сохранить изменения
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