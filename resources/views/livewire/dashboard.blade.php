<div class="py-10" x-data="{ activeTab: 'overview' }">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-16">
        <!-- Stats Cards Component -->
        @livewire('dashboard.stats-cards')

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Announcements Component -->
            <div class="lg:col-span-2">
                @livewire('dashboard.announcements')
            </div>

            <!-- Quick Actions -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones Rápidas</h3>
                        <div class="space-y-3">
                            <a href="{{ route('empleados.crear') }}" 
                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow">
                                <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-blue-500 rounded-lg">
                                    <i class="fas fa-user-plus text-white"></i>
                                </span>
                                <span class="flex-1 ml-3 whitespace-nowrap">Nuevo Empleado</span>
                                <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                            <a href="{{ route('departamentos.crear') }}" 
                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow">
                                <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-green-500 rounded-lg">
                                    <i class="fas fa-building text-white"></i>
                                </span>
                                <span class="flex-1 ml-3 whitespace-nowrap">Nuevo Departamento</span>
                                <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                            <a href="{{ route('memos.crear') }}" 
                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow">
                                <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-yellow-500 rounded-lg">
                                    <i class="fas fa-file-alt text-white"></i>
                                </span>
                                <span class="flex-1 ml-3 whitespace-nowrap">Nuevo Memo</span>
                                <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                            <a href="{{ route('anuncios.crear') }}" 
                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow">
                                <span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-purple-500 rounded-lg">
                                    <i class="fas fa-bullhorn text-white"></i>
                                </span>
                                <span class="flex-1 ml-3 whitespace-nowrap">Nuevo Anuncio</span>
                                <span class="inline-flex items-center justify-center px-2 py-0.5 ml-3 text-xs font-medium text-gray-500 bg-gray-200 rounded">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
