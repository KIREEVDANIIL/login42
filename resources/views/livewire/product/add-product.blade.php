<div>
    <button wire:click="toggleForm"
            class="mb-6 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        {{ $is_active ? 'Cancel' : 'Add Product' }}
    </button>

    @if($is_active)
        <div class="border rounded p-6 bg-white">
            <h3 class="text-lg font-semibold mb-4">New Product</h3>
            
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm mb-1">Name</label>
                        <input type="text" wire:model="name"
                               class="w-full border rounded px-3 py-2">
                        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Price ($)</label>
                        <input type="number" wire:model="price" min="0" step="0.01"
                               class="w-full border rounded px-3 py-2">
                        @error('price') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Stock</label>
                        <input type="number" wire:model="count" min="0"
                               class="w-full border rounded px-3 py-2">
                        @error('count') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Category</label>
                        <select wire:model="category_id" class="w-full border rounded px-3 py-2">
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm mb-1">Country</label>
                        <select wire:model="country_id" class="w-full border rounded px-3 py-2">
                            <option value="">Select country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm mb-1">Image</label>
                        <input type="file" wire:model="image" class="w-full border rounded px-3 py-2">
                        @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm mb-1">Description</label>
                        <textarea wire:model="description" rows="3"
                                  class="w-full border rounded px-3 py-2"></textarea>
                        @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" wire:model="is_active">
                            <span class="text-sm">Active</span>
                        </label>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit"
                                class="px-6 py-2 bg-black text-white rounded hover:bg-gray-800">
                            Save Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @endif
</div>