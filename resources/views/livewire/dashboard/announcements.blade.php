<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
        <h3 class="text-lg font-semibold text-white flex items-center">
            Comunicados Importantes
        </h3>
    </div>
    <div class="p-6">
        <div class="space-y-6">
            @forelse($memos as $memo)
                <div class="group relative rounded-xl border-2 border-red-200 bg-gradient-to-br from-red-50 to-white hover:from-red-100 overflow-hidden transition-all duration-300 hover:shadow-lg">
                    <div class="absolute top-3 right-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            {{ $memo->department->name }}
                        </span>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col h-full">
                            <h4 class="text-lg font-semibold text-gray-900 group-hover:text-red-600 transition-colors duration-200">
                                {{ $memo->title }}
                            </h4>
                            <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                                {{ $memo->content }}
                            </p>
                            <div class="mt-4 pt-3 border-t border-red-100">
                                <div class="flex justify-between items-center text-sm text-gray-500">
                                    <span>
                                        <i class="far fa-clock mr-1"></i>
                                        {{ $memo->published_at->format('d/m/Y H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center py-4">No hay comunicados importantes para tu departamento</p>
            @endforelse
        </div>
    </div>
</div>
