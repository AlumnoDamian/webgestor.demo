<div class="py-10">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-16">
        <!-- Tabla y contenido principal -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <!-- Barra de herramientas -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                    <div class="flex flex-1 w-full md:w-auto gap-4">
                        <!-- Buscador -->
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" wire:model.live.debounce.300ms="search" 
                                class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500" 
                                placeholder="Buscar por nombre, descripción o ubicación...">
                        </div>

                        <!-- Registros por página -->
                        <div class="flex items-center bg-white rounded-lg border border-gray-300">
                            <select wire:model.live="perPage" class="text-sm text-gray-900 border-0 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 p-2.5">
                                <option value="10">10 por página</option>
                                <option value="25">25 por página</option>
                                <option value="50">50 por página</option>
                                <option value="100">100 por página</option>
                            </select>
                        </div>
                    </div>

                    <!-- Botón Nuevo Departamento -->
                    <div>
                        <button wire:click="openFormModal" type="button" class="flex items-center justify-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                            </svg>
                            Nuevo Departamento
                        </button>
                    </div>
                </div>

                <!-- Tabla -->
                <div class="overflow-x-auto">
                    <!-- Contador de registros -->
                    <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                        <p class="text-sm text-gray-700 text-center">
                            <span class="font-semibold text-gray-900">{{ $departments->total() }}</span> registros en total
                        </p>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                            <th wire:click="sortBy('code')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                    Código
                                    @if ($sortField === 'code')
                                        <span class="ml-1">
                                            @if ($sortDirection === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        </span>
                                    @endif
                                </th>
                                <th wire:click="sortBy('name')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                    Nombre
                                    @if ($sortField === 'name')
                                        <span class="ml-1">
                                            @if ($sortDirection === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        </span>
                                    @endif
                                </th>
                                <th wire:click="sortBy('description')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                    Descripción
                                    @if ($sortField === 'description')
                                        <span class="ml-1">
                                            @if ($sortDirection === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        </span>
                                    @endif
                                </th>
                                <th wire:click="sortBy('budget')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                    Presupuesto
                                    @if ($sortField === 'budget')
                                        <span class="ml-1">
                                            @if ($sortDirection === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        </span>
                                    @endif
                                </th>
                                <th wire:click="sortBy('employees_count')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                    Empleados
                                    @if ($sortField === 'employees_count')
                                        <span class="ml-1">
                                            @if ($sortDirection === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        </span>
                                    @endif
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($departments as $department)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $department->code }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $department->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500 max-w-xs overflow-hidden text-ellipsis">
                                            {{ $department->description }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ number_format($department->budget, 2, ',', '.') }} €
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $department->employees_count ?? $department->employees()->count() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button wire:click="openFormModal({{ $department->id }})"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m14.3 4.8 2.9 2.9M7 7H4a1 1 0 0 0-1 1v10c0 .6.4 1 1 1h11c.6 0 1-.4 1-1v-4.5m2.4-10a2 2 0 0 1 0 3l-6.8 6.8L8 14l.7-3.6 6.9-6.8a2 2 0 0 1 2.8 0Z" />
                                            </svg>
                                        </button>
                                        <button wire:click="confirmDelete({{ $department->id }})"
                                            class="text-red-600 hover:text-red-900">
                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No hay departamentos registrados
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
                                    class="relative inline-flex items-center px-3 py-2 text-sm font-medium rounded-l-md
                                    {{ $departments->onFirstPage() 
                                        ? 'text-gray-400 bg-gray-50 cursor-not-allowed' 
                                        : 'text-gray-700 bg-white hover:bg-indigo-50 hover:text-indigo-600' }}
                                    border border-gray-300 focus:z-20 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
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
                                    class="relative inline-flex items-center px-3 py-2 text-sm font-medium rounded-r-md
                                    {{ !$departments->hasMorePages() 
                                        ? 'text-gray-400 bg-gray-50 cursor-not-allowed' 
                                        : 'text-gray-700 bg-white hover:bg-indigo-50 hover:text-indigo-600' }}
                                    border border-gray-300 focus:z-20 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de formulario -->
        @if($showFormModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" wire:key="modal-{{ now() }}">
                <!-- Modal backdrop -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity"></div>
                
                <div class="flex min-h-screen items-center justify-center p-4">
                    <div class="relative w-full max-w-[80%]">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
    {{ $editingDepartmentId ? 'Editar Departamento' : 'Nuevo Departamento' }}
                                </h3>
                                <button type="button" wire:click="closeFormModal"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Cerrar modal</span>
                                </button>
                            </div>

                            <!-- Modal body -->
                            <div class="p-6">
                                @livewire('department.department-form', ['department' => $editingDepartmentId], 'form-'.$editingDepartmentId)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Modal de Confirmación de Eliminación -->
        @if($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" wire:key="delete-modal-{{ now() }}">
            <!-- Modal backdrop -->
            <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity"></div>
            
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative w-full max-w-md">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Confirmar eliminación del departamento
                            </h3>
                            <button type="button" wire:click="closeDeleteModal"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Cerrar modal</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <div class="p-6">
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                ¿Estás seguro de que deseas eliminar el departamento de <span class="font-semibold">{{ $departmentToDelete?->name }}</span>?
                                Esta acción no se puede deshacer.
                            </p>
                            
                            <div class="flex justify-end gap-4">
                                <button wire:click="closeDeleteModal" type="button" 
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-indigo-300">
                                    Cancelar
                                </button>
                                <button wire:click="deleteDepartment" type="button"
                                    class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
