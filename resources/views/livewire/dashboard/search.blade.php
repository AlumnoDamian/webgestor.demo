<div class="mb-6 flex flex-col sm:flex-row gap-4 items-center justify-between">
    <div class="relative flex-1">
        <input 
            wire:model.live.debounce.300ms="searchTerm"
            type="text" 
            class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Buscar anuncios..."
            x-data
            x-on:focus="$el.classList.add('ring-2', 'ring-blue-500')"
            x-on:blur="$el.classList.remove('ring-2', 'ring-blue-500')"
        >
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400"></i>
        </div>
    </div>
</div>
