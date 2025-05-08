<div>
    <!-- Employee Card -->
    @if($currentEmployee)
    <div class="mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <!-- Header -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            @if($currentEmployee->photo)
                                <img class="h-20 w-20 rounded-full object-cover border-4 border-blue-500" 
                                    src="{{ Storage::url($currentEmployee->photo) }}" 
                                    alt="{{ $currentEmployee->name }}">
                            @else
                                <div class="h-20 w-20 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 border-4 border-blue-500 flex items-center justify-center">
                                    <span class="text-3xl text-white font-bold">{{ substr($currentEmployee->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $currentEmployee->name }}</h3>
                        </div>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $employeeData['estado'] === 'Activo' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' }}">
                            {{ $employeeData['estado'] }}
                        </span>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                    <!-- Departamento -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Departamento</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $currentEmployee->department_name ?? 'Sin departamento' }}</p>
                                @if($currentEmployee->department_description)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $currentEmployee->department_description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Contacto -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Contacto</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $currentEmployee->email }}</p>
                                @if($currentEmployee->phone)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $currentEmployee->phone }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Antigüedad -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Antigüedad</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $employeeData['antiguedad'] }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Inicio: {{ $employeeData['fecha_inicio'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Días en la empresa -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Días en la empresa</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $employeeData['dias_empresa'] }} días</p>
                            </div>
                        </div>
                    </div>
                </div>
                @if(!$currentEmployee->department_name)
                    <div class="mt-6 w-full bg-gradient-to-r from-yellow-50 to-amber-50 dark:from-yellow-900/50 dark:to-amber-900/50 rounded-xl p-6 border border-yellow-200 dark:border-yellow-800">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <svg class="w-12 h-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-yellow-800 dark:text-yellow-200">Departamento no asignado</h3>
                                <p class="text-yellow-600 dark:text-yellow-400 mt-1">Por favor, contacta con recursos humanos para la asignación de tu departamento.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @else
        <div class="mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <!-- Header con nombre de usuario -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="h-20 w-20 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 border-4 border-blue-500 flex items-center justify-center">
                                    <span class="text-3xl text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="bg-gradient-to-r from-yellow-50 to-amber-50 dark:from-yellow-900/50 dark:to-amber-900/50 rounded-xl p-6 border border-yellow-200 dark:border-yellow-800">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-12 h-12 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-yellow-800 dark:text-yellow-200">Sin datos de empleado</h3>
                                    <p class="text-yellow-600 dark:text-yellow-400 mt-1">No hay información de empleado asignada a tu cuenta. Por favor, contacta con recursos humanos para completar tus datos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Empleados Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300 h-full flex flex-col">
            <div class="p-6 flex-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0 bg-indigo-500 rounded-lg p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="flex items-center space-x-1">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Total</div>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $departmentEmployees }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Empleados en el departamento</p>
            </div>
            <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 dark:from-indigo-900 dark:to-indigo-800 px-6 py-3 mt-auto">
                <div class="text-xs font-medium text-indigo-600 dark:text-indigo-300 uppercase tracking-wider">Plantilla Total</div>
            </div>
        </div>

        <!-- Empleados Activos Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300 h-full flex flex-col">
            <div class="p-6 flex-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0 bg-green-500 rounded-lg p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex items-center space-x-1">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Activos</div>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $activeEmployees }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">Empleados activos</p>
            </div>
            <div class="bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900 dark:to-green-800 px-6 py-3 mt-auto">
                <div class="text-xs font-medium text-green-600 dark:text-green-300 uppercase tracking-wider">En Activo</div>
            </div>
        </div>

        <!-- Edad Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300 h-full flex flex-col">
            <div class="p-6 flex-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0 bg-blue-500 rounded-lg p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div class="flex items-center space-x-1">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Edad</div>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                    @if($employeeData['edad'] !== 'N/A')
                        {{ $employeeData['edad'] }}
                    @else
                        <span class="text-yellow-600 dark:text-yellow-400 text-xl italic">No disponible</span>
                    @endif
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Nacimiento: 
                    @if($employeeData['fecha_nacimiento'] !== 'No registrada')
                        {{ $employeeData['fecha_nacimiento'] }}
                    @else
                        <span class="text-yellow-600 dark:text-yellow-400 italic">No registrada</span>
                    @endif
                </p>
            </div>
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900 dark:to-blue-800 px-6 py-3 mt-auto">
                <div class="text-xs font-medium text-blue-600 dark:text-blue-300 uppercase tracking-wider">Datos Personales</div>
            </div>
        </div>

        <!-- Distribución de Roles Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-all duration-300 h-full flex flex-col">
            <div class="p-6 flex-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0 bg-purple-500 rounded-lg p-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="flex items-center space-x-1">
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">Roles</div>
                    </div>
                </div>

                @if($currentEmployee->department_id)
                    <div class="space-y-2">
                        @foreach($percentages as $role => $percentage)
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ ucfirst($role) }}</span>
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $percentage }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="h-2 rounded-full bg-purple-500"
                                    style="width: {{ $percentage }}%"></div>
                            </div>
                        @endforeach
                        <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                            Total: {{ $departmentEmployees }} empleados
                        </div>
                    </div>
                @else
                    <div class="flex items-center space-x-3 text-yellow-600 dark:text-yellow-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span class="text-lg font-semibold">No asignado a departamento</span>
                    </div>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Contacta con RRHH para ser asignado a un departamento y ver la distribución de roles.
                    </p>
                @endif
            </div>
            <div class="bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900 dark:to-purple-800 px-6 py-3 mt-auto">
                <div class="text-xs font-medium text-purple-600 dark:text-purple-300 uppercase tracking-wider">Distribución</div>
            </div>
        </div>
    </div>
</div>
