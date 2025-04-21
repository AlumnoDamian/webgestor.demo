<div class="py-8">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-16">
        @if($successMessage)
            <div class="mb-3 flex items-center justify-between p-3 bg-green-100 rounded-lg" x-data="{ show: true }"
                x-show="show" x-init="setTimeout(() => { show = false; $wire.clearSuccessMessage() }, 3000)">
                <p class="text-green-700">{{ $successMessage }}</p>
                <button @click="show = false" class="text-green-700 hover:text-green-900">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        @endif

        <!-- Card Principal del Perfil -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-2xl text-white">account_circle</span>
                        <div>
                            <h3 class="text-xl font-bold text-white">Perfil del Empleado</h3>
                            <p class="text-sm text-blue-100">Última actualización: {{ $employee->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                    <button class="text-white hover:text-blue-100 transition-colors duration-200">
                        <span class="material-symbols-outlined">edit</span>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Columna Izquierda - Foto y Detalles Principales -->
                    <div class="flex flex-col items-center space-y-4 md:w-1/4">
                        <div class="relative group">
                            @if($employee->image)
                                <img src="{{ Storage::url($employee->image) }}" alt="{{ $employee->name }}"
                                    class="h-36 w-36 rounded-2xl object-cover ring-4 ring-blue-500 ring-offset-4 dark:ring-offset-gray-800 shadow-xl">
                            @else
                                <div class="h-36 w-36 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 ring-4 ring-blue-500 ring-offset-4 dark:ring-offset-gray-800 shadow-xl flex items-center justify-center">
                                    <span class="text-5xl text-white font-bold">{{ substr($employee->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 rounded-2xl bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                                <span class="material-symbols-outlined text-2xl text-white">photo_camera</span>
                            </div>
                        </div>
                        
                        <div class="text-center space-y-3">
                            <h4 class="text-xl font-bold text-gray-900 dark:text-white">{{ $employee->name }}</h4>
                            <div class="flex flex-wrap justify-center gap-2">
                                <div class="inline-flex items-center px-3 py-1.5 rounded-lg text-base font-medium bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg">
                                    <span class="material-symbols-outlined text-sm mr-2">work</span>
                                    {{ $employee->role }}
                                </div>
                                <div class="inline-flex items-center px-3 py-1.5 rounded-lg text-base font-medium 
                                    {{ $employee->is_active 
                                        ? 'bg-gradient-to-r from-green-500 to-green-600 text-white' 
                                        : 'bg-gradient-to-r from-red-500 to-red-600 text-white' }} shadow-lg">
                                    <span class="material-symbols-outlined text-sm mr-2">
                                        {{ $employee->is_active ? 'check_circle' : 'cancel' }}
                                    </span>
                                    {{ $employee->is_active ? 'Activo' : 'Inactivo' }}
                                </div>
                            </div>
                            <p class="text-base text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-3 py-1.5 rounded-lg inline-block">
                                ID: #{{ $employee->user_id }}
                            </p>
                        </div>

                        <!-- Insignias y Logros -->
                        <div class="w-full">
                            <h5 class="text-base font-semibold text-gray-600 dark:text-gray-300 mb-2 text-center">Insignias y Logros</h5>
                            <div class="flex flex-wrap justify-center gap-2">
                                @if($employee->created_at->diffInYears() >= 1)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                        <span class="material-symbols-outlined text-sm mr-1">military_tech</span>
                                        {{ $employee->created_at->diffInYears() }}+ años
                                    </span>
                                @endif
                                @if($employee->department)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        <span class="material-symbols-outlined text-sm mr-1">groups</span>
                                        {{ $employee->department->name }}
                                    </span>
                                @endif
                                @if($employee->is_active)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        <span class="material-symbols-outlined text-sm mr-1">verified</span>
                                        Verificado
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha - Información Detallada -->
                    <div class="flex-1">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Información de Contacto -->
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-5 shadow-inner">
                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center mb-4">
                                    <span class="material-symbols-outlined text-xl mr-2 text-blue-500">contact_mail</span>
                                    Información de Contacto
                                </h5>
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-3 p-3 bg-white dark:bg-gray-600 rounded-lg shadow-sm">
                                        <span class="material-symbols-outlined text-xl text-blue-500">mail</span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $employee->email }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3 p-3 bg-white dark:bg-gray-600 rounded-lg shadow-sm">
                                        <span class="material-symbols-outlined text-xl text-blue-500">phone</span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Teléfono</p>
                                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $employee->phone ?? 'No especificado' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3 p-3 bg-white dark:bg-gray-600 rounded-lg shadow-sm">
                                        <span class="material-symbols-outlined text-xl text-blue-500">home</span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Dirección</p>
                                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $employee->address ?? 'No especificada' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Información Personal -->
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-5 shadow-inner">
                                <h5 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center mb-4">
                                    <span class="material-symbols-outlined text-xl mr-2 text-blue-500">person</span>
                                    Información Personal
                                </h5>
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-3 p-3 bg-white dark:bg-gray-600 rounded-lg shadow-sm">
                                        <span class="material-symbols-outlined text-xl text-blue-500">badge</span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">DNI</p>
                                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $employee->dni }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3 p-3 bg-white dark:bg-gray-600 rounded-lg shadow-sm">
                                        <span class="material-symbols-outlined text-xl text-blue-500">cake</span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Nacimiento</p>
                                            <p class="text-base font-semibold text-gray-900 dark:text-white">
                                                {{ $employee->birth_date ? $employee->birth_date->format('d/m/Y') : 'No especificada' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3 p-3 bg-white dark:bg-gray-600 rounded-lg shadow-sm">
                                        <span class="material-symbols-outlined text-xl text-blue-500">calendar_today</span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de Ingreso</p>
                                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $employee->created_at->format('d/m/Y') }}</p>
                                            <p class="text-sm text-blue-500">{{ $employee->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información Detallada en Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Estado y Rol -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-4">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <span class="material-symbols-outlined mr-2">badge</span>
                        Estado y Rol
                    </h3>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Estado Actual con Detalles -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 shadow-inner">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-2xl {{ $employee->is_active ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $employee->is_active ? 'check_circle' : 'cancel' }}
                                </span>
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Estado Actual</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $employee->is_active ? 'Empleado activo en la empresa' : 'Empleado inactivo' }}
                                    </p>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium 
                                {{ $employee->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' }}">
                                {{ $employee->is_active ? 'ACTIVO' : 'INACTIVO' }}
                            </span>
                        </div>
                    </div>

                    <!-- Rol y Responsabilidades -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 shadow-inner">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="material-symbols-outlined text-2xl text-purple-500">admin_panel_settings</span>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">Rol y Departamento</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Posición actual en la empresa</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 shadow-sm">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Rol</p>
                                <p class="text-sm font-semibold text-purple-600 dark:text-purple-300 capitalize">{{ $employee->role }}</p>
                            </div>
                            <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 shadow-sm">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Departamento</p>
                                <p class="text-sm font-semibold text-purple-600 dark:text-purple-300">
                                    {{ $employee->department->name ?? 'No asignado' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tiempo en la empresa -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 shadow-inner">
                        <div class="flex items-center gap-3 mb-3">
                            <span class="material-symbols-outlined text-2xl text-purple-500">schedule</span>
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">Antigüedad</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tiempo en la empresa</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 shadow-sm">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Fecha de Ingreso</p>
                                <p class="text-sm font-semibold text-purple-600 dark:text-purple-300">
                                    {{ $employee->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 shadow-sm">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Tiempo Total</p>
                                <p class="text-sm font-semibold text-purple-600 dark:text-purple-300">
                                    {{ $employee->created_at->diffForHumans(null, true) }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-3 pt-2 border-t border-gray-200 dark:border-gray-600">
                            <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400">
                                <span>Progreso del año</span>
                                <span>{{ floor(($employee->created_at->diffInDays(now()) % 365) / 365 * 100) }}%</span>
                            </div>
                            <div class="mt-1 h-1.5 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
                                <div class="h-full bg-purple-500 rounded-full" 
                                     style="width: {{ floor(($employee->created_at->diffInDays(now()) % 365) / 365 * 100) }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actividad y Estadísticas -->
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 p-4">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <span class="material-symbols-outlined mr-2">analytics</span>
                        Actividad y Estadísticas
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Estadísticas del Departamento -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 shadow-inner">
                        <h4 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-2xl text-indigo-500">groups</span>
                            Estadísticas del Departamento
                        </h4>
                        <div class="grid grid-cols-3 gap-3">
                            <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 text-center shadow-sm">
                                <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 mb-2">
                                    <span class="material-symbols-outlined text-sm text-blue-600 dark:text-blue-300">group</span>
                                </div>
                                <p class="text-lg font-bold text-blue-600 dark:text-blue-300">{{ $departmentEmployees['total'] }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Total</p>
                            </div>
                            <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 text-center shadow-sm">
                                <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 mb-2">
                                    <span class="material-symbols-outlined text-sm text-green-600 dark:text-green-300">check_circle</span>
                                </div>
                                <p class="text-lg font-bold text-green-600 dark:text-green-300">{{ $departmentEmployees['active'] }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Activos</p>
                            </div>
                            <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 text-center shadow-sm">
                                <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900 mb-2">
                                    <span class="material-symbols-outlined text-sm text-purple-600 dark:text-purple-300">person_add</span>
                                </div>
                                <p class="text-lg font-bold text-purple-600 dark:text-purple-300">{{ $departmentEmployees['recentJoins'] }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Nuevos</p>
                            </div>
                        </div>
                    </div>

                    <!-- Distribución de Roles -->
                    @if($roleDistribution)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 shadow-inner">
                        <h4 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-2xl text-indigo-500">pie_chart</span>
                            Distribución de Roles
                        </h4>
                        <div class="space-y-4">
                            @foreach($roleDistribution as $role => $count)
                            <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 shadow-sm">
                                <div class="flex mb-2 items-center justify-between">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white px-2 py-1 bg-indigo-100 dark:bg-indigo-900 rounded-full">
                                        {{ $role }}
                                    </span>
                                    <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-300">
                                        {{ $count }} empleados
                                    </span>
                                </div>
                                <div class="relative pt-1">
                                    <div class="overflow-hidden h-2 text-xs flex rounded bg-indigo-200 dark:bg-indigo-900">
                                        <div style="width:{{ ($count / $departmentEmployees['total']) * 100 }}%" 
                                             class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Estadísticas de Edad -->
                    @if(isset($ageData) && isset($ageData['departmentAverage']))
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 shadow-inner">
                        <h4 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-2xl text-indigo-500">calendar_today</span>
                            Estadísticas de Edad
                        </h4>
                        <div class="grid grid-cols-2 gap-3 mb-3">
                            <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 text-center shadow-sm">
                                <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900 mb-2">
                                    <span class="material-symbols-outlined text-sm text-indigo-600 dark:text-indigo-300">groups</span>
                                </div>
                                <p class="text-lg font-bold text-indigo-600 dark:text-indigo-300">{{ number_format($ageData['departmentAverage'], 1) }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Promedio Dept.</p>
                            </div>
                            <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 text-center shadow-sm">
                                <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 dark:bg-indigo-900 mb-2">
                                    <span class="material-symbols-outlined text-sm text-indigo-600 dark:text-indigo-300">person</span>
                                </div>
                                <p class="text-lg font-bold text-indigo-600 dark:text-indigo-300">{{ $ageData['employeeAge'] }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">Tu Edad</p>
                            </div>
                        </div>
                        @if(isset($ageData['oldestAge']) && isset($ageData['youngestAge']) && $ageData['oldestAge'] > $ageData['youngestAge'])
                        <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 shadow-sm">
                            <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400 mb-2">
                                <span>{{ $ageData['youngestAge'] }} años</span>
                                <span>{{ $ageData['oldestAge'] }} años</span>
                            </div>
                            <div class="relative pt-1">
                                <div class="overflow-hidden h-2 text-xs flex rounded bg-indigo-200 dark:bg-indigo-900">
                                    <div style="width:{{ (($ageData['employeeAge'] - $ageData['youngestAge']) / ($ageData['oldestAge'] - $ageData['youngestAge'])) * 100 }}%" 
                                         class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Estadísticas de Memos -->
                    @if($memoStats['total'] > 0)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 shadow-inner">
                        <h4 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-2xl text-indigo-500">description</span>
                            Memos del Departamento
                        </h4>
                        <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 text-center shadow-sm mb-3">
                            <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 dark:bg-yellow-900 mb-2">
                                <span class="material-symbols-outlined text-sm text-yellow-600 dark:text-yellow-300">folder</span>
                            </div>
                            <p class="text-lg font-bold text-yellow-600 dark:text-yellow-300">{{ $memoStats['total'] }}</p>
                            <p class="text-xs text-gray-600 dark:text-gray-400">Total Memos</p>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            @foreach($memoStats['byType'] as $type => $count)
                            <div class="bg-white dark:bg-gray-600 rounded-lg px-3 py-2 text-center shadow-sm">
                                <p class="text-lg font-bold 
                                    {{ $type === 'Importante' ? 'text-red-600 dark:text-red-300' : 
                                       ($type === 'Informativo' ? 'text-blue-600 dark:text-blue-300' : 
                                       'text-yellow-600 dark:text-yellow-300') }}">
                                    {{ $count }}
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">{{ $type }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>