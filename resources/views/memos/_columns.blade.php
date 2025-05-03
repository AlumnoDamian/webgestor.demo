<!-- Grid de columnas con altura automática -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 auto-rows-min">
    <!-- Columna Importantes -->
    @php
        $importantMemos = $memos->where('type', 'Importante');
        $informativeMemos = $memos->where('type', 'Informativo');
        $urgentMemos = $memos->where('type', 'Urgente');
    @endphp

    @if($importantMemos->count() > 0)
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden h-fit">
            <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4">
                <h3 class="text-lg font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Importantes ({{ $importantMemos->count() }})
                </h3>
            </div>
            <div class="p-6 space-y-6">
                @forelse($importantMemos as $memo)
                    <div
                        class="group relative rounded-xl border-2 border-red-200 bg-gradient-to-br from-red-50 to-white hover:from-red-100 overflow-hidden transition-all duration-300 hover:shadow-lg h-fit">
                        <div class="absolute top-3 right-3 transition-all duration-200">
                            <button
                                onclick="openEditModal({{ $memo->id }}, '{{ $memo->title }}', '{{ $memo->type }}', '{{ $memo->content }}', '{{ $memo->department->id }}', '{{ $memo->published_at }}')"
                                class="inline-flex items-center px-3 py-2 bg-white/90 hover:bg-blue-50 text-gray-600 hover:text-blue-600 rounded-lg border border-gray-200 hover:border-blue-300 transition-all duration-200 shadow-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                <span class="text-sm font-medium">Editar</span>
                            </button>
                        </div>
                        <div class="p-3">
                            <div class="flex items-start">
                                <div class="flex-grow">
                                    <h4 class="text-lg font-bold text-gray-800 group-hover:text-gray-900 mb-2 pr-16">
                                        {{ $memo->title }}</h4>
                                    <div class="flex items-center space-x-3 mb-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            Importante
                                        </span>
                                        <span class="inline-flex items-center text-xs text-gray-500">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $memo->published_at }}
                                        </span>
                                    </div>
                                    <div class="bg-white/50 rounded-lg p-3 mb-4 border border-red-100">
                                        <p class="text-gray-600 leading-relaxed text-sm">{{ $memo->content }}</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            <span class="text-sm text-gray-600">{{ $memo->department->name }}</span>
                                        </div>
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
    @endif

    <!-- Columna Informativos -->
    @if($informativeMemos->count() > 0)
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden h-fit">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <h3 class="text-lg font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Informativos ({{ $informativeMemos->count() }})
                </h3>
            </div>
            <div class="p-6 space-y-6">
                @forelse($informativeMemos as $memo)
                    <div
                        class="group relative rounded-xl border-2 border-blue-200 bg-gradient-to-br from-blue-50 to-white hover:from-blue-100 overflow-hidden transition-all duration-300 hover:shadow-lg h-fit">
                        <div class="absolute top-3 right-3 transition-all duration-200">
                            <button
                                onclick="openEditModal({{ $memo->id }}, '{{ $memo->title }}', '{{ $memo->type }}', '{{ $memo->content }}', '{{ $memo->department->id }}', '{{ $memo->published_at }}')"
                                class="inline-flex items-center px-3 py-2 bg-white/90 hover:bg-blue-50 text-gray-600 hover:text-blue-600 rounded-lg border border-gray-200 hover:border-blue-300 transition-all duration-200 shadow-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                <span class="text-sm font-medium">Editar</span>
                            </button>
                        </div>
                        <div class="p-3">
                            <div class="flex items-start">
                                <div class="flex-grow">
                                    <h4 class="text-lg font-bold text-gray-800 group-hover:text-gray-900 mb-2 pr-16">
                                        {{ $memo->title }}</h4>
                                    <div class="flex items-center space-x-3 mb-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Informativo
                                        </span>
                                        <span class="inline-flex items-center text-xs text-gray-500">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $memo->published_at }}
                                        </span>
                                    </div>
                                    <div class="bg-white/50 rounded-lg p-3 mb-4 border border-blue-100">
                                        <p class="text-gray-600 leading-relaxed text-sm">{{ $memo->content }}</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            <span class="text-sm text-gray-600">{{ $memo->department->name }}</span>
                                        </div>
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
    @endif

    <!-- Columna Urgentes -->
    @if($urgentMemos->count() > 0)
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden h-fit">
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 px-6 py-4">
                <h3 class="text-lg font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    Urgentes ({{ $urgentMemos->count() }})
                </h3>
            </div>
            <div class="p-6 space-y-6">
                @forelse($urgentMemos as $memo)
                    <div
                        class="group relative rounded-xl border-2 border-yellow-200 bg-gradient-to-br from-yellow-50 to-white hover:from-yellow-100 overflow-hidden transition-all duration-300 hover:shadow-lg h-fit">
                        <div class="absolute top-3 right-3 transition-all duration-200">
                            <button
                                onclick="openEditModal({{ $memo->id }}, '{{ $memo->title }}', '{{ $memo->type }}', '{{ $memo->content }}', '{{ $memo->department->id }}', '{{ $memo->published_at }}')"
                                class="inline-flex items-center px-3 py-2 bg-white/90 hover:bg-blue-50 text-gray-600 hover:text-blue-600 rounded-lg border border-gray-200 hover:border-blue-300 transition-all duration-200 shadow-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                <span class="text-sm font-medium">Editar</span>
                            </button>
                        </div>
                        <div class="p-3">
                            <div class="flex items-start">
                                <div class="flex-grow">
                                    <h4 class="text-lg font-bold text-gray-800 group-hover:text-gray-900 mb-2 pr-16">
                                        {{ $memo->title }}</h4>
                                    <div class="flex items-center space-x-3 mb-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            Urgente
                                        </span>
                                        <span class="inline-flex items-center text-xs text-gray-500">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $memo->published_at }}
                                        </span>
                                    </div>
                                    <div class="bg-white/50 rounded-lg p-3 mb-4 border border-yellow-100">
                                        <p class="text-gray-600 leading-relaxed text-sm">{{ $memo->content }}</p>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            <span class="text-sm text-gray-600">{{ $memo->department->name }}</span>
                                        </div>
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
    @endif
</div>