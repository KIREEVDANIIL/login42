<div>
    <h2 class="text-lg font-semibold mb-4">Users</h2>

    @if($users->isEmpty())
        <p class="text-gray-500 italic">No users</p>
    @else
        <div class="space-y-3">
            @foreach($users as $user)
                <div class="flex justify-between items-center p-3 bg-white border rounded">
                    <div>
                        <div class="font-medium">{{ $user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                    </div>
                    
                    <button wire:click="deleteUser({{ $user->id }})"
                            wire:confirm="Delete user?"
                            class="text-sm text-red-600 hover:text-red-800">
                        Delete
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>