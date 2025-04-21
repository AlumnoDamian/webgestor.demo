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
                                placeholder="Buscar por nombre, email, DNI, teléfono, rol o departamento...">
                        </div>

                        <!-- Filtro de Activos -->
                        <div class="flex items-center bg-white px-4 py-2 rounded-lg border border-gray-300">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model.live="showOnlyActive" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-indigo-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                <span class="ml-3 text-sm font-medium text-gray-700">Solo Activos</span>
                            </label>
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

                    <!-- Botón Nuevo Empleado -->
                    <div>
                        <button wire:click="openFormModal" type="button" class="flex items-center justify-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                            <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                            </svg>
                            Nuevo Empleado
                        </button>
                    </div>
                </div>

                <!-- Información de registros y Tabla -->
                <div class="overflow-x-auto">
                    <!-- Contador de registros -->
                    <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                        <p class="text-sm text-gray-700 text-center">
                            <span class="font-semibold text-gray-900">{{ $employees->total() }}</span> registros en total
                        </p>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
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
                                <th wire:click="sortBy('email')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                    Email
                                    @if ($sortField === 'email')
                                        <span class="ml-1">
                                            @if ($sortDirection === 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        </span>
                                    @endif
                                </th>
                                <th wire:click="sortBy('dni')"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                    DNI
                                    @if ($sortField === 'dni')
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
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Teléfono
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($employees as $employee)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($employee->image)
                                                <img class="h-10 w-10 rounded-full object-cover mr-3"
                                                    src="{{ asset('storage/' . $employee->image) }}"
                                                    alt="{{ $employee->name }}">
                                            @else
                                                <div
                                                    class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-3">
                                                    <span
                                                        class="text-gray-500 text-sm">{{ substr($employee->name, 0, 2) }}</span>
                                                </div>
                                            @endif
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $employee->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $employee->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $employee->dni }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $employee->phone }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $employee->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $employee->is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button wire:click="openFormModal({{ $employee->id }})"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button wire:click="confirmDelete({{ $employee->id }})"
                                            class="text-red-600 hover:text-red-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                        No se encontraron empleados
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
                                <button @if($employees->onFirstPage()) disabled @endif
                                    wire:click="previousPage"
                                    class="relative inline-flex items-center px-3 py-2 text-sm font-medium rounded-l-md
                                    {{ $employees->onFirstPage() 
                                        ? 'text-gray-400 bg-gray-50 cursor-not-allowed' 
                                        : 'text-gray-700 bg-white hover:bg-indigo-50 hover:text-indigo-600' }}
                                    border border-gray-300 focus:z-20 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <!-- Números de página -->
                                @php
                                    $currentPage = $employees->currentPage();
                                    $lastPage = $employees->lastPage();
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
                                <button @if(!$employees->hasMorePages()) disabled @endif
                                    wire:click="nextPage"
                                    class="relative inline-flex items-center px-3 py-2 text-sm font-medium rounded-r-md
                                    {{ !$employees->hasMorePages() 
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

        <!-- Modal de Formulario de Empleado -->
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
                                {{ $editingEmployeeId ? 'Editar Empleado' : 'Crear Nuevo Empleado' }}
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
                            @livewire('employee.employee-form', ['employee' => $editingEmployeeId], 'form-'.$editingEmployeeId)
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
                                Confirmar eliminación del empleado
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
                                ¿Estás seguro de que deseas eliminar al empleado <span class="font-semibold">{{ $employeeToDelete?->name }}</span>?
                                Esta acción no se puede deshacer.
                            </p>
                            
                            <div class="flex justify-end gap-4">
                                <button wire:click="closeDeleteModal" type="button" 
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-indigo-300">
                                    Cancelar
                                </button>
                                <button wire:click="deleteEmployee" type="button"
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