<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Anuncios recientes</h3>
        <div class="space-y-4">
            @forelse($announcements as $announcement)
                <div 
                    class="border-l-4 border-blue-500 pl-4 py-3"
                    x-data="{ expanded: false }"
                    x-transition
                >
                    <div class="flex items-center justify-between">
                        <h4 class="text-md font-medium text-gray-900">{{ $announcement->title }}</h4>
                        <button 
                            @click="expanded = !expanded"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            <i class="fas" :class="expanded ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                        </button>
                    </div>
                    <div class="text-sm text-gray-500 mt-1">
                        {{ $announcement->published_at->diffForHumans() }}
                    </div>
                    <div 
                        x-show="expanded"
                        x-collapse
                        class="mt-2 text-gray-600"
                    >
                        {{ $announcement->content }}
                    </div>
                </div>
            @empty
                <div class="text-gray-500 text-center py-4">
                    No hay anuncios recientes
                </div>
            @endforelse
        </div>
        <div class="mt-4">
            {{ $announcements->links() }}
        </div>
    </div>
</div>
