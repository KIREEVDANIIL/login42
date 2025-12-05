<div class="space-y-6">
    <!-- Заголовок и управление -->
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold text-gray-900">Категории</h2>
        
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <label class="text-sm text-gray-600">На странице:</label>
                <select wire:model="limit" wire:change="changeLimit" 
                        class="border border-gray-300 rounded-lg px-3 py-1 text-sm">
                    @foreach ($list_paginate as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
            
            <input wire:model.live.debounce.300ms="search" 
                   type="text" 
                   placeholder="Поиск..." 
                   class="border border-gray-300 rounded-lg px-4 py-2 text-sm w-64 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
    </div>

    <!-- Таблица -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        @if (count($categories) < 1)
            <div class="text-center py-12">
                <p class="text-gray-500">Категории не найдены</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            @foreach ($fields as $key => $field)
                                <th wire:click='changeField("{{ $field }}")' 
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100">
                                    <div class="flex items-center gap-1">
                                        <span>{{ $field }}</span>
                                        <x-sort :field="$field" :orderByField="$orderByField" :direction="$orderByDirection" />
                                    </div>
                                </th>
                            @endforeach
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Действия
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($categories as $category)
                            <tr wire:key="{{ $category->id }}" 
                                class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $category->id }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $category->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <button wire:click="deleteCategory({{ $category->id }})"
                                            wire:confirm="Удалить категорию?"
                                            class="px-3 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg border border-red-200 text-sm transition-colors">
                                        Удалить
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Пагинация -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>