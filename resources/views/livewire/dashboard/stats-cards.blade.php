<div>
    <!-- Employee Card -->
    @if($currentEmployee)
    <div class="mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="p-6">
                <!-- Header -->
                <div class="flex items-center space-x-4 mb-4">
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
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $currentEmployee->name }}</h3>
                        <p class="text-lg text-blue-600 dark:text-blue-400">{{ $currentEmployee->position }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="px-4 py-2 rounded-full text-sm font-semibold {{ $employeeData['estado'] === 'Activo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $employeeData['estado'] }}
                        </span>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                    <!-- Departamento -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-building text-2xl text-blue-500"></i>
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
                                <i class="fas fa-envelope text-2xl text-blue-500"></i>
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
                                <i class="fas fa-calendar-alt text-2xl text-blue-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Antigüedad</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $employeeData['antiguedad'] }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Inicio: {{ $employeeData['fecha_inicio'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de Contrato -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-file-contract text-2xl text-blue-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Tipo de Contrato</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $employeeData['tipo_contrato'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Horario -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-clock text-2xl text-blue-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Horario</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $employeeData['horario'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Días en la empresa -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-business-time text-2xl text-blue-500"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Días en la empresa</p>
                                <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $employeeData['dias_empresa'] }} días</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        @foreach($stats as $key => $stat)
        <div 
            class="bg-gradient-to-br from-{{ $stat['color'] }}-500 to-{{ $stat['color'] }}-600 overflow-hidden shadow-lg rounded-lg p-6 text-white"
            x-data="{ hover: false }"
            @mouseenter="hover = true"
            @mouseleave="hover = false"
            :class="{ 'transform scale-105 transition-all duration-300': hover }"
        >
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm opacity-80">{{ ucfirst($key) }}</div>
                    <div class="text-3xl font-bold mt-2">{{ $stat['count'] }}</div>
                </div>
                <div class="text-4xl opacity-80">
                    <i class="fas fa-{{ $stat['icon'] }}"></i>
                </div>
            </div>
            <div class="mt-4 text-sm">
                @if(isset($stat['trend']))
                    <span class="{{ $stat['trend'] > 0 ? 'text-green-300' : 'text-red-300' }}">
                        <i class="fas fa-{{ $stat['trend'] > 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                        {{ abs(round($stat['trend'])) }}%
                    </span>
                    vs mes anterior
                @else
                    <span class="text-{{ $stat['color'] }}-300">
                        <i class="fas fa-check-circle"></i>
                        {{ $stat['active'] }} activos
                    </span>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
