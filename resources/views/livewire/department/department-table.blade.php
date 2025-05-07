<div class="py-10">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-16">
        <!-- Tabla y contenido principal -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <!-- Barra de herramientas -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                    <div class="flex flex-wrap gap-3">
                        <!-- Registros por página -->
                        @foreach ([5, 10, 20, 50] as $value)
                            <button type="button" wire:click="$set('perPage', {{ $value }})" 
                                class="group relative min-w-[100px] px-4 py-3 
                                    rounded-lg border shadow-sm transition-all duration-300 ease-in-out
                                    {{ $perPage === $value
                                        ? 'bg-gradient-to-b from-blue-50 to-blue-100 border-blue-300 shadow-inner'
                                        : 'bg-gradient-to-b from-white to-gray-50 border-gray-200 hover:border-blue-400 hover:from-blue-50 hover:to-white hover:shadow-md hover:-translate-y-0.5' }}
                                    focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 relative">
                                            <div class="absolute inset-0 bg-blue-100 rounded-lg transform -rotate-6 transition-transform group-hover:rotate-6">
                                            </div>
                                            <svg class="relative w-5 h-5 text-blue-600 transform transition-transform group-hover:scale-110"
                                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium {{ $perPage === $value ? 'text-blue-900' : 'text-gray-900' }}">
                                            {{ $value }} registros
                                        </span>
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>

                    <!-- Botón Nuevo Departamento -->
                    @role('admin')
                    <button wire:click="openFormModal" class="group inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 
                                        border-0 rounded-lg font-semibold text-base text-white tracking-wide shadow-md
                                        hover:from-blue-700 hover:via-indigo-700 hover:to-indigo-800 
                                        focus:outline-none focus:ring-2 focus:ring-blue-500/50
                                        active:from-blue-800 active:via-indigo-800 active:to-indigo-900
                                        transition-all duration-200 ease-in-out
                                        min-w-[200px] transform hover:-translate-y-0.5">
                        <span class="material-symbols-outlined text-xl leading-none relative top-[1px] mr-2">apartment</span>
                        <span class="relative">
                            Nuevo Departamento
                            <span class="absolute -bottom-0.5 left-0 w-full h-0.5 bg-white/30 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                        </span>
                    </button>
                    @endrole
                </div>

                <!-- Tabla -->
                <div class="overflow-hidden bg-white shadow-xl rounded-lg border border-gray-200">
                    <!-- Contador y estadísticas de departamentos -->
                    <div class="bg-gradient-to-br from-indigo-50 via-white to-blue-50">
                        <!-- Encabezado con total -->
                        <div class="px-6 py-5 border-b border-gray-200/80">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <div class="p-3 bg-gradient-to-br from-indigo-600 to-blue-600 rounded-xl shadow-lg shadow-indigo-100 transform transition-transform hover:scale-105">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                        </div>
                                        <div class="absolute -top-1 -right-1">
                                            <span class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-white bg-indigo-600 text-[10px] font-bold text-white">
                                                {{ $departments->total() }}
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                            Departamentos
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                                                Total: {{ $departments->total() }}
                                            </span>
                                        </h3>
                                        <p class="text-sm text-gray-500 flex items-center mt-1">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                            </svg>
                                            Mostrando <span class="font-medium mx-1">{{ $departments->firstItem() }}</span> a
                                            <span class="font-medium mx-1">{{ $departments->lastItem() }}</span>
                                            de la página {{ $departments->currentPage() }} de {{ $departments->lastPage() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="hidden sm:block">
                                    <div class="inline-flex rounded-lg shadow-sm" role="group">
                                        <button type="button" class="px-4 py-2 text-sm font-medium text-indigo-600 bg-white border border-indigo-200 rounded-l-lg hover:bg-indigo-50 focus:z-10 focus:ring-2 focus:ring-indigo-500 focus:text-indigo-700">
                                            <div class="font-semibold">{{ $departments->where('status', true)->count() }}</div>
                                            <div class="text-xs text-indigo-600/80">Activos</div>
                                        </button>
                                        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border-t border-b border-gray-200 hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-indigo-500 focus:text-indigo-700">
                                            <div class="font-semibold">{{ $departments->avg('employees_count') }}</div>
                                            <div class="text-xs text-gray-600/80">Promedio Emp.</div>
                                        </button>
                                        <button type="button" class="px-4 py-2 text-sm font-medium text-red-600 bg-white border border-red-200 rounded-r-lg hover:bg-red-50 focus:z-10 focus:ring-2 focus:ring-indigo-500 focus:text-indigo-700">
                                            <div class="font-semibold">{{ $departments->where('status', false)->count() }}</div>
                                            <div class="text-xs text-red-600/80">Inactivos</div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Barra de estadísticas -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div class="px-6 py-4 bg-gradient-to-br from-transparent to-indigo-50/50 h-full">
                                    <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Departamento más grande</div>
                                    <div class="mt-2">
                                        @php
                                            $largestDept = $departments->sortByDesc('employees_count')->first();
                                        @endphp
                                        <div class="text-lg font-semibold text-gray-900">
                                            {{ $largestDept->name ?? 'No hay departamentos' }}: <span class="text-lg text-gray-600">{{ $largestDept->employees_count ?? 0 }} empleados</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div class="px-6 py-4 bg-gradient-to-br from-transparent to-blue-50/50 h-full">
                                    <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Departamento más pequeño</div>
                                    <div class="mt-2">
                                        @php
                                            $smallestDept = $departments->sortBy('employees_count')->first();
                                        @endphp
                                        <div class="text-lg font-semibold text-gray-900">
                                            {{ $smallestDept->name ?? 'No hay departamentos' }}: <span class="text-lg text-gray-600">{{ $smallestDept->employees_count ?? 0 }} empleados</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div class="px-6 py-4 bg-gradient-to-br from-transparent to-indigo-50/50 h-full">
                                    <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total empleados</div>
                                    <div class="mt-2">
                                        <div class="text-lg font-semibold text-gray-900">
                                            {{ $departments->sum('employees_count') }} <span class="text-lg text-gray-600">personas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('code')" class="group inline-flex items-center hover:text-indigo-700">
                                        Código
                                        <x-sort-icon :field="'code'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('name')" class="group inline-flex items-center hover:text-indigo-700">
                                        Nombre
                                        <x-sort-icon :field="'name'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('manager_id')" class="group inline-flex items-center hover:text-indigo-700">
                                        Jefe
                                        <x-sort-icon :field="'manager_id'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('budget')" class="group inline-flex items-center hover:text-indigo-700">
                                        Presupuesto
                                        <x-sort-icon :field="'budget'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('phone')" class="group inline-flex items-center hover:text-indigo-700">
                                        Teléfono
                                        <x-sort-icon :field="'phone'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('email')" class="group inline-flex items-center hover:text-indigo-700">
                                        Email
                                        <x-sort-icon :field="'email'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('status')" class="group inline-flex items-center hover:text-indigo-700">
                                        Estado
                                        <x-sort-icon :field="'status'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($departments as $department)
                                <tr class="transition-colors hover:bg-gray-50/50">
                                    <td class="whitespace-nowrap px-4 py-4 text-sm font-medium text-gray-900">
                                        <div class="flex items-center">
                                            <span class="font-mono bg-gray-100 text-gray-800 px-2.5 py-0.5 rounded-md">{{ $department->code }}</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        <div class="font-medium">{{ $department->name }}</div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        <div class="flex items-center">
                                            @if($department->manager)
                                                <div class="h-8 w-8 flex-shrink-0">
                                                    <div class="relative h-8 w-8">
                                                        <div class="h-full w-full rounded-full bg-gray-100 flex items-center justify-center">
                                                            <span class="text-xs font-medium text-gray-500">
                                                                {{ substr($department->manager->name, 0, 2) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="font-medium text-gray-900">{{ $department->manager->name }}</div>
                                                </div>
                                            @else
                                                <span class="text-gray-500 italic">Sin asignar</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        <div class="font-medium text-gray-900">
                                            {{ number_format($department->budget, 2, ',', '.') }} €
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        @if($department->phone)
                                            <div class="flex items-center text-gray-500">
                                                {{ $department->phone }}
                                            </div>
                                        @else
                                            <span class="text-gray-500 italic">No disponible</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        @if($department->email)
                                            <div class="flex items-center text-gray-500">
                                                {{ $department->email }}
                                            </div>
                                        @else
                                            <span class="text-gray-500 italic">No disponible</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-900">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $department->status ? 'bg-green-100 text-green-800 ring-1 ring-green-600/20' : 'bg-red-100 text-red-800 ring-1 ring-red-600/20' }}">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 {{ $department->status ? 'text-green-400' : 'text-red-400' }}" fill="currentColor" viewBox="0 0 8 8">
                                                @if($department->status)
                                                    <circle cx="4" cy="4" r="3"/>
                                                @else
                                                    <path d="M2.5 1L1 2.5m0 0L2.5 4m-1.5-1.5h3m2 0L4.5 4m1.5-1.5L4.5 1m1.5 1.5h-3"/>
                                                @endif
                                            </svg>
                                            {{ $department->status ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @can('ver_botones_tabla')
                                        <div class="flex justify-end space-x-2">
                                            <button wire:click="openFormModal({{ $department->id }})"
                                                class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-1.5 rounded-md transition-colors">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <button wire:click="confirmDelete({{ $department->id }})"
                                                class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-1.5 rounded-md transition-colors">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                            <div class="mt-3 text-sm text-gray-500">No hay departamentos registrados</div>
                                            <button wire:click="openFormModal" type="button" 
                                                class="mt-4 inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 
                                                       hover:from-blue-700 hover:via-indigo-700 hover:to-indigo-800 
                                                       rounded-lg shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                                                       transition-all duration-200 transform hover:-translate-y-0.5">
                                                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Crear departamento
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación siempre visible -->
                <div class="mt-4 sm:mt-6">
                    <div class="flex flex-col items-center gap-4">
                        <!-- Paginador -->
                        <div class="flex justify-center px-4 py-3 bg-white border border-gray-200 rounded-lg shadow-sm w-full sm:w-auto">
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                <!-- Botón Anterior -->
                                <button @if($departments->onFirstPage()) disabled @endif
                                    wire:click="previousPage"
                                    class="relative inline-flex items-center rounded-l-md px-3 py-2 text-sm font-medium
                                    {{ $departments->onFirstPage() 
                                        ? 'text-gray-400 bg-gray-50 cursor-not-allowed' 
                                        : 'text-gray-700 bg-white hover:bg-indigo-50 hover:text-indigo-600' }}">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                    </svg>
                                    <span class="sr-only">Anterior</span>
                                </button>

                                <!-- Números de página -->
                                @php
                                    $currentPage = $departments->currentPage();
                                    $lastPage = $departments->lastPage();
                                    $pages = [];
                                    
                                    if ($lastPage <= 5) {
                                        $pages = range(1, $lastPage);
                                    } else {
                                        $startPage = max(min($currentPage - 2, $lastPage - 4), 1);
                                        $endPage = min($startPage + 4, $lastPage);
                                        $pages = range($startPage, $endPage);
                                    }
                                @endphp

                                @foreach($pages as $page)
                                    @if($page == $currentPage)
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 border border-indigo-600">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <button wire:click="gotoPage({{ $page }})"
                                            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-indigo-50 hover:text-indigo-600 focus:z-20 transition-colors duration-200">
                                            {{ $page }}
                                        </button>
                                    @endif
                                @endforeach

                                <!-- Botón Siguiente -->
                                <button @if(!$departments->hasMorePages()) disabled @endif
                                    wire:click="nextPage"
                                    class="relative inline-flex items-center rounded-r-md px-3 py-2 text-sm font-medium
                                    {{ !$departments->hasMorePages() 
                                        ? 'text-gray-400 bg-gray-50 cursor-not-allowed' 
                                        : 'text-gray-700 bg-white hover:bg-indigo-50 hover:text-indigo-600' }}">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                    <span class="sr-only">Siguiente</span>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de formulario -->
        @if($showFormModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex min-h-screen items-center justify-center p-4">
                <!-- Background overlay con blur -->
                <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

                <!-- Modal panel -->
                <div class="relative w-full max-w-7xl bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all border border-gray-100">
                    <!-- Header del modal con gradiente -->
                    <div class="bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 px-6 py-4">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-semibold text-white tracking-wide">
                                {{ $editingDepartmentId ? 'Editar Departamento' : 'Nuevo Departamento' }}
                            </h3>
                            <button type="button" wire:click="closeFormModal" class="text-white/80 hover:text-white transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Modal body -->
                    <div>
                        @livewire('department.department-form', ['department' => $editingDepartmentId])
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Modal de Confirmación de Eliminación -->
        @if($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" wire:key="delete-modal-{{ now() }}">
            <!-- Modal backdrop -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm transition-opacity"></div>
            
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative w-full max-w-md">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b border-gray-200">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-red-100 rounded-lg">
                                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900">
                                    Confirmar eliminación
                                </h3>
                            </div>
                            <button type="button" wire:click="closeDeleteModal"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span class="sr-only">Cerrar modal</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="p-6 space-y-4">
                            <p class="text-base text-gray-700">
                                ¿Estás seguro de que deseas eliminar el departamento <span class="font-semibold text-gray-900">{{ $departmentToDelete?->name }}</span>?
                            </p>
                            <p class="text-sm text-gray-500">
                                Esta acción no se puede deshacer. Se eliminarán todos los datos asociados al departamento.
                            </p>
                        </div>

                        <!-- Modal footer -->
                        <div class="flex items-center justify-end gap-3 p-4 border-t border-gray-200">
                            <button wire:click="closeDeleteModal" type="button" 
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                                transition-all duration-200 transform hover:-translate-y-0.5">
                                Cancelar
                            </button>
                            <button wire:click="deleteDepartment" type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 
                                transition-all duration-200 transform hover:-translate-y-0.5">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
