@php
    $importantMemos = $memos->where('type', 'Importante');
    $informativeMemos = $memos->where('type', 'Informativo');
    $urgentMemos = $memos->where('type', 'Urgente');
@endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Columna Importantes -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden h-fit">
        <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
            <h3 class="text-lg font-semibold text-white flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                Importantes ({{ $importantMemos->count() }})
            </h3>
        </div>
        <div class="p-6">
            <div class="space-y-6">
                @forelse($importantMemos as $memo)
                    <div class="group relative rounded-xl border-2 border-red-200 bg-gradient-to-br from-red-50 to-white hover:from-red-100 overflow-hidden transition-all duration-300 hover:shadow-lg">
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
                    <p class="text-gray-500 text-center py-4">No hay comunicados importantes</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Columna Informativos -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden h-fit">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
            <h3 class="text-lg font-semibold text-white flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Informativos ({{ $informativeMemos->count() }})
            </h3>
        </div>
        <div class="p-6">
            <div class="space-y-6">
                @forelse($informativeMemos as $memo)
                    <div class="group relative rounded-xl border-2 border-blue-200 bg-gradient-to-br from-blue-50 to-white hover:from-blue-100 overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <div class="p-6">
                            <div class="flex flex-col h-full">
                                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">
                                    {{ $memo->title }}
                                </h4>
                                <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                                    {{ $memo->content }}
                                </p>
                                <div class="mt-4 pt-3 border-t border-blue-100">
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
                    <p class="text-gray-500 text-center py-4">No hay comunicados informativos</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Columna Urgentes -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden h-fit">
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
            <h3 class="text-lg font-semibold text-white flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Urgentes ({{ $urgentMemos->count() }})
            </h3>
        </div>
        <div class="p-6">
            <div class="space-y-6">
                @forelse($urgentMemos as $memo)
                    <div class="group relative rounded-xl border-2 border-amber-200 bg-gradient-to-br from-amber-50 to-white hover:from-amber-100 overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <div class="p-6">
                            <div class="flex flex-col h-full">
                                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-amber-600 transition-colors duration-200">
                                    {{ $memo->title }}
                                </h4>
                                <p class="mt-2 text-sm text-gray-600 line-clamp-2">
                                    {{ $memo->content }}
                                </p>
                                <div class="mt-4 pt-3 border-t border-amber-100">
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
                    <p class="text-gray-500 text-center py-4">No hay comunicados urgentes</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
