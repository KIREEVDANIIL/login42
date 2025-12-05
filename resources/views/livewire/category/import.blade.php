<div>
    <form wire:submit="import">
        <div class="mb-2">
            <input type="file" 
                   id="file-upload"
                   wire:model="file"
                   class="block w-full text-sm text-gray-500
                   file:mr-4 file:py-2 file:px-4
                   file:rounded file:border
                   file:text-sm file:font-medium
                   file:bg-gray-50 file:text-gray-700
                   hover:file:bg-gray-100">
            
            @error('file')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <button type="submit"
                class="px-3 py-2 bg-gray-800 text-white rounded hover:bg-gray-900">
            Import
        </button>
    </form>
</div>