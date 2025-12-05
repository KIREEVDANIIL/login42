<div>
    <div class="mb-4 flex justify-between">
        <input wire:model.live="search" 
               placeholder="Search..." 
               class="border rounded px-3 py-1">
    </div>
    
    @if($categories->isEmpty())
        <p class="text-gray-500">No categories</p>
    @else
        <div class="space-y-2">
            @foreach($categories as $category)
                <div class="flex justify-between items-center p-3 border rounded">
                    <div>
                        <span class="text-gray-500 text-sm">#{{ $category->id }}</span>
                        <span class="ml-2">{{ $category->name }}</span>
                    </div>
                    <button wire:click="deleteCategory({{ $category->id }})"
                            class="text-red-500 text-sm">
                        Delete
                    </button>
                </div>
            @endforeach
        </div>
        
        <div class="mt-4">
            {{ $categories->links() }}
        </div>
    @endif
</div>