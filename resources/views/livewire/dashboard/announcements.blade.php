@php
    $importantMemos = $memos->where('type', 'Importante');
    $informativeMemos = $memos->where('type', 'Informativo');
    $urgentMemos = $memos->where('type', 'Urgente');
@endphp

@if($memos->isEmpty())
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <div class="w-full">
                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 dark:from-yellow-900/50 dark:to-amber-900/50 rounded-xl p-6 border border-yellow-200 dark:border-yellow-800">
                    @if(!Auth::user()->employee || !Auth::user()->employee->department_id)
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <svg class="w-12 h-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-yellow-800 dark:text-yellow-200">Departamento no asignado</h3>
                                <p class="text-yellow-600 dark:text-yellow-400 mt-1">No puedes ver los comunicados hasta que tengas un departamento asignado. Por favor, contacta con recursos humanos.</p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <svg class="w-12 h-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-yellow-800 dark:text-yellow-200">Sin comunicados</h3>
                                <p class="text-yellow-600 dark:text-yellow-400 mt-1">No hay comunicados para tu departamento en este momento.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Columna Importantes -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden h-fit w-full">
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
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden h-fit w-full">
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
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden h-fit w-full">
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
@endif
