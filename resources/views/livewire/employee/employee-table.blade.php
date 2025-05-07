<div class="py-10">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-16">
        <!-- Tabla y contenido principal -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                @if (session()->has('message'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Barra de herramientas -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                    <div class="flex flex-1 w-full md:w-auto gap-4">
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
                        <button wire:click="openFormModal" type="button" 
                            class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 
                                   hover:from-blue-700 hover:via-indigo-700 hover:to-indigo-800 
                                   rounded-lg shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                                   transition-all duration-200 transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            Nuevo Empleado
                        </button>
                    </div>
                </div>

                <!-- Información de registros y Tabla -->
                <div class="overflow-hidden bg-white shadow-xl rounded-lg border border-gray-200">
                    <!-- Contador y estadísticas de empleados -->
                    <div class="bg-gradient-to-br from-indigo-50 via-white to-blue-50">
                        <!-- Encabezado con total -->
                        <div class="px-6 py-5 border-b border-gray-200/80">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <div class="p-3 bg-gradient-to-br from-indigo-600 to-blue-600 rounded-xl shadow-lg shadow-indigo-100 transform transition-transform hover:scale-105">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                            </svg>
                                        </div>
                                        <div class="absolute -top-1 -right-1">
                                            <span class="flex h-5 w-5 items-center justify-center rounded-full border-2 border-white bg-indigo-600 text-[10px] font-bold text-white">
                                                {{ $employees->total() }}
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                            Empleados
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                                                Total: {{ $employees->total() }}
                                            </span>
                                        </h3>
                                        <p class="text-sm text-gray-500 flex items-center mt-1">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                                            </svg>
                                            Mostrando <span class="font-medium mx-1">{{ $employees->firstItem() }}</span> a
                                            <span class="font-medium mx-1">{{ $employees->lastItem() }}</span>
                                            de la página {{ $employees->currentPage() }} de {{ $employees->lastPage() }}
                                        </p>
                                    </div>
                                </div>
                                <div class="hidden sm:block">
                                    <div class="inline-flex rounded-lg shadow-sm" role="group">
                                        <button type="button" class="px-4 py-2 text-sm font-medium text-indigo-600 bg-white border border-indigo-200 rounded-l-lg hover:bg-indigo-50 focus:z-10 focus:ring-2 focus:ring-indigo-500 focus:text-indigo-700">
                                            <div class="font-semibold">{{ $totalActive }}</div>
                                            <div class="text-xs text-indigo-600/80">Activos</div>
                                        </button>
                                        <button type="button" class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border-t border-b border-gray-200 hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-indigo-500 focus:text-indigo-700">
                                            <div class="font-semibold">{{ $rolesDistribution->count() }}</div>
                                            <div class="text-xs text-gray-600/80">Tipos de Rol</div>
                                        </button>
                                        <button type="button" class="px-4 py-2 text-sm font-medium text-red-600 bg-white border border-red-200 rounded-r-lg hover:bg-red-50 focus:z-10 focus:ring-2 focus:ring-indigo-500 focus:text-indigo-700">
                                            <div class="font-semibold">{{ $totalInactive }}</div>
                                            <div class="text-xs text-red-600/80">Inactivos</div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Barra de estadísticas -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div class="px-6 py-4 bg-gradient-to-br from-transparent to-blue-50/50 h-full">
                                    <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Rol más común</div>
                                    <div class="mt-2">
                                        @php
                                            $commonRole = $rolesDistribution->sortByDesc('total')->first();
                                            $roleName = $commonRole ? ucfirst(strtolower($commonRole->role)) : 'N/A';
                                            $roleCount = $commonRole ? $commonRole->total : 0;
                                        @endphp
                                        <div class="text-lg font-semibold text-gray-900">
                                            {{ $roleName }}: <span class="text-lg text-gray-600">{{ $roleCount }} {{ $roleCount === 1 ? 'empleado' : 'empleados' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div class="px-6 py-4 bg-gradient-to-br from-transparent to-blue-50/50 h-full">
                                    <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Departamento más grande</div>
                                    <div class="mt-2">
                                        @php
                                            $largestDept = \App\Models\Department::withCount('employees')
                                                ->orderByDesc('employees_count')
                                                ->first();
                                            $employeeCount = $largestDept?->employees_count ?? 0;
                                        @endphp
                                        <div class="text-lg font-semibold text-gray-900">
                                            {{ $largestDept?->name ?? 'No tiene' }}: <span class="text-lg text-gray-600">{{ $employeeCount }} {{ $employeeCount === 1 ? 'empleado' : 'empleados' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                <div class="px-6 py-4 bg-gradient-to-br from-transparent to-indigo-50/50 h-full">
                                    <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Empleados recientes</div>
                                    <div class="mt-2">
                                        @php
                                            $recentCount = \App\Models\Employee::where('hire_date', '>=', now()->subMonths(3))->count();
                                        @endphp
                                        <div class="text-lg font-semibold text-gray-900">
                                            {{ $recentCount }} <span class="text-lg text-gray-600">{{ $recentCount === 1 ? 'empleado nuevo' : 'empleados nuevos' }} este trimestre</span>
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
                                    <button type="button" wire:click="sortBy('name')" class="group inline-flex items-center hover:text-indigo-700">
                                        Empleado
                                        <x-sort-icon :field="'name'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('dni')" class="group inline-flex items-center hover:text-indigo-700">
                                        DNI
                                        <x-sort-icon :field="'dni'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('role')" class="group inline-flex items-center hover:text-indigo-700">
                                        Rol
                                        <x-sort-icon :field="'role'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('department_id')" class="group inline-flex items-center hover:text-indigo-700">
                                        Departamento
                                        <x-sort-icon :field="'department_id'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('hire_date')" class="group inline-flex items-center hover:text-indigo-700">
                                        Fecha Ingreso
                                        <x-sort-icon :field="'hire_date'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('birth_date')" class="group inline-flex items-center hover:text-indigo-700">
                                        Edad
                                        <x-sort-icon :field="'birth_date'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Contacto
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    <button type="button" wire:click="sortBy('is_active')" class="group inline-flex items-center hover:text-indigo-700">
                                        Estado
                                        <x-sort-icon :field="'is_active'" :sort-field="$sortField" :sort-direction="$sortDirection" />
                                    </button>
                                </th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Acciones</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($employees as $employee)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                @if($employee->image)
                                                    <img class="h-10 w-10 rounded-full object-cover ring-2 ring-indigo-100" src="{{ asset('storage/' . $employee->image) }}" alt="{{ $employee->name }}">
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-100 to-indigo-200 flex items-center justify-center ring-2 ring-indigo-100">
                                                        <span class="text-lg font-medium text-indigo-700">{{ strtoupper(substr($employee->name, 0, 1)) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">{{ $employee->name }}</div>
                                                <div class="text-sm text-gray-500 flex items-center space-x-1">
                                                    <span>{{ $employee->email }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-1.5">
                                            <div class="font-mono text-sm text-gray-900 bg-gray-100 px-2.5 py-0.5 rounded-md inline-block">
                                                {{ $employee->dni }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-1.5">
                                            @if($employee->role)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                    {{ ucfirst($employee->role) }}
                                                </span>
                                            @else
                                                <span class="text-gray-500 italic">Sin asignar</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                @if($employee->department)
                                                    <div class="text-sm text-gray-900">{{ $employee->department->name }}</div>
                                                    <div class="text-xs text-gray-500">Código: {{ $employee->department->code }}</div>
                                                @else
                                                    <div class="text-sm text-gray-500 italic">Sin asignar</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                @if($employee->hire_date)
                                                    <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($employee->hire_date)->format('d/m/Y') }}</div>
                                                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($employee->hire_date)->diffForHumans() }}</div>
                                                @else
                                                    <div class="text-sm text-gray-500 italic">Sin asignar</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                @if($employee->birth_date)
                                                    <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($employee->birth_date)->format('d/m/Y') }}</div>
                                                    <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($employee->birth_date)->age }} años</div>
                                                @else
                                                    <div class="text-sm text-gray-500 italic">Sin asignar</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm">
                                            @if($employee->phone || $employee->address)
                                                @if($employee->phone)
                                                    <div class="text-gray-900">{{ $employee->phone }}</div>
                                                @endif
                                                @if($employee->address)
                                                    <div class="text-gray-900">{{ $employee->address }}</div>
                                                @endif
                                                @if(!$employee->phone)
                                                    <div class="text-gray-500 italic">Sin teléfono</div>
                                                @endif
                                                @if(!$employee->address)
                                                    <div class="text-gray-500 italic">Sin dirección</div>
                                                @endif
                                            @else
                                                <div class="text-gray-500 italic">Sin asignar</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $employee->is_active ? 'bg-green-100 text-green-800 ring-1 ring-green-600/20' : 'bg-red-100 text-red-800 ring-1 ring-red-600/20' }}">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 {{ $employee->is_active ? 'text-green-400' : 'text-red-400' }}" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            {{ $employee->is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <button wire:click="edit({{ $employee->id }})"
                                                class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 p-1.5 rounded-md transition-colors">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <button wire:click="confirmDelete({{ $employee->id }})"
                                                class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 p-1.5 rounded-md transition-colors">
                                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No hay empleados registrados.
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
                                    class="relative inline-flex items-center rounded-l-md px-3 py-2 text-sm font-medium
                                    {{ $employees->onFirstPage() 
                                        ? 'text-gray-400 bg-gray-50 cursor-not-allowed' 
                                        : 'text-gray-700 bg-white hover:bg-indigo-50 hover:text-indigo-600' }}">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                    </svg>
                                    <span class="sr-only">Anterior</span>
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
                                    class="relative inline-flex items-center rounded-r-md px-3 py-2 text-sm font-medium
                                    {{ !$employees->hasMorePages() 
                                        ? 'text-gray-400 bg-gray-50 cursor-not-allowed' 
                                        : 'text-gray-700 bg-white hover:bg-indigo-50 hover:text-indigo-600' }}">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                    <span class="sr-only">Siguiente</span>
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
            <!-- Background overlay con blur -->
            <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>
            
            <div class="flex min-h-screen items-center justify-center p-4">
                <div class="relative w-full max-w-7xl">
                    @livewire('employee.employee-form', ['employee' => $editingEmployeeId], 'form-'.$editingEmployeeId)
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
                                ¿Estás seguro de que deseas eliminar al empleado <span class="font-semibold text-gray-900">{{ $employeeToDelete?->name }}</span>?
                            </p>
                            <p class="text-sm text-gray-500">
                                Esta acción no se puede deshacer. Se eliminarán todos los datos asociados al empleado.
                            </p>
                        </div>

                        <!-- Modal footer -->
                        <div class="flex items-center justify-end gap-3 p-4 border-t border-gray-200">
                            <button wire:click="closeDeleteModal" type="button" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-300">
                                Cancelar
                            </button>
                            <button wire:click="deleteEmployee" type="button"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg focus:ring-4 focus:ring-red-300">
                                Eliminar empleado
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>