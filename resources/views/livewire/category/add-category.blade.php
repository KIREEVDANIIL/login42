<div>
    <form wire:submit="addCategory" class="space-y-3">
        <input wire:model="name"
               placeholder="Category name"
               class="w-full border rounded px-3 py-2">
        
        @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
        
        <button type="submit" class="px-4 py-2 bg-black text-white rounded">
            Add Category
        </button>
    </form>
</div>