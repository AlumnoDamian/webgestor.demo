<x-app-layout>
    <div class="py-10">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-16">
            <!-- Selector de departamento -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 mb-8">
                <div class="w-full sm:w-[24rem]">
                    <select name="department" id="department"
                        class="block w-full py-3 px-4 text-base border border-gray-300 bg-white rounded-lg shadow-sm
                                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                            transition-all duration-200 hover:border-blue-400 hover:from-blue-50 hover:to-white hover:shadow-md hover:-translate-y-0.5"
                        onchange="window.location.href='{{ route('cuadrante.view') }}?department=' + this.value">
                        <option value="">Seleccionar departamento</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ request()->input('department') == $dept->id ? 'selected' : '' }}>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if(!isset($employees) || $employees->count() == 0)
                <!-- Mensaje cuando no hay empleados -->
                <div class="mt-6 p-8 bg-gradient-to-br from-emerald-50 via-green-50 to-teal-50 rounded-xl shadow-lg border border-emerald-200/50 relative overflow-hidden">
                    <!-- Elementos decorativos -->
                    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-emerald-200/20 to-green-300/20 rounded-full -translate-y-48 translate-x-48 blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-72 h-72 bg-gradient-to-tr from-teal-200/20 to-emerald-300/20 rounded-full translate-y-36 -translate-x-36 blur-3xl"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full bg-gradient-to-r from-emerald-100/10 via-transparent to-green-100/10 rounded-full blur-2xl"></div>

                    <!-- Contenido -->
                    <div class="relative z-10">
                        <div class="flex-1">
                            <div class="bg-white/60 backdrop-blur-lg rounded-xl p-8 shadow-sm border border-emerald-100/50">
                                <!-- Ícono y título -->
                                <div class="flex items-center space-x-4 mb-6">
                                    <div class="p-3 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl shadow-lg shadow-emerald-500/20 rotate-3 hover:rotate-0 transition-transform duration-300">
                                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-green-600 bg-clip-text text-transparent">
                                            Consulta de Horarios
                                        </h3>
                                        <p class="text-gray-600 mt-1">Selecciona un departamento para comenzar</p>
                                    </div>
                                </div>

                                <!-- Instrucciones -->
                                <div class="space-y-4">
                                    <div class="flex items-center space-x-3 bg-gradient-to-r from-emerald-50 to-emerald-100/50 p-4 rounded-lg border border-emerald-200/50 transform hover:scale-[1.02] transition-all duration-300">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center transform -rotate-3">
                                                <span class="text-emerald-600 font-bold text-lg">1</span>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-emerald-800">Selecciona el departamento</h4>
                                            <p class="text-emerald-600 text-sm">Utiliza el menú desplegable superior</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-3 bg-gradient-to-r from-green-50 to-green-100/50 p-4 rounded-lg border border-green-200/50 transform hover:scale-[1.02] transition-all duration-300">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center transform rotate-3">
                                                <span class="text-green-600 font-bold text-lg">2</span>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-green-800">Visualiza los horarios</h4>
                                            <p class="text-green-600 text-sm">Consulta los turnos de la semana actual</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-3 bg-gradient-to-r from-teal-50 to-teal-100/50 p-4 rounded-lg border border-teal-200/50 transform hover:scale-[1.02] transition-all duration-300">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center transform -rotate-3">
                                                <span class="text-teal-600 font-bold text-lg">3</span>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-teal-800">Revisa la leyenda</h4>
                                            <p class="text-teal-600 text-sm">Para entender los diferentes turnos</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nota adicional -->
                                <div class="mt-8 flex items-start space-x-4 bg-white/80 p-4 rounded-lg border border-emerald-100">
                                    <div class="p-2 bg-emerald-100 rounded-lg">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="font-medium text-gray-800 mb-1">Actualización automática</h5>
                                        <p class="text-gray-600 text-sm">Los horarios se actualizan automáticamente cada semana para mantener la información siempre al día.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="week-table block">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <!-- Encabezado mejorado -->
                        <div class="bg-gradient-to-b from-gray-50 to-gray-100">
                            <div class="bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 py-3 pl-3 flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-white/10 rounded-lg p-2">
                                        <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none">
                                            <path d="M8 2V5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 2V5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M3.5 9.09H20.5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-white text-base font-semibold tracking-wide">
                                            Semana Actual
                                        </h3>
                                        <p class="text-blue-100 text-sm">
                                            {{ $dates[0][0]['dayNumber'] }} {{ $dates[0][0]['month'] }} -
                                            {{ $dates[0][6]['dayNumber'] }} {{ $dates[0][6]['month'] }}
                                        </p>
                                    </div>
                                </div>
                                <!-- Botón de leyenda -->
                                <button type="button" onclick="showLegend()" class="mr-4 px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg flex items-center space-x-2 transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Ver leyenda</span>
                                </button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-b from-gray-50 to-gray-100">
                                    <tr>
                                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider w-56 border-r border-gray-200">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-7 h-7 rounded-full bg-blue-100/50 flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none">
                                                        <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </div>
                                                <span>Empleado</span>
                                            </div>
                                        </th>
                                        @foreach($dates[0] as $day)
                                        <th class="py-3 px-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider border-r border-gray-200 w-24">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <span class="text-sm text-gray-600 font-semibold tracking-wide">{{ $day['dayName'] }}</span>
                                                    <div class="flex items-center bg-blue-50 rounded px-2 py-0.5">
                                                        <span class="text-sm font-bold text-blue-600">{{ $day['dayNumber'] }}</span>
                                                        <span class="text-xs text-gray-500 ml-1">{{ $day['month'] }}</span>
                                                    </div>
                                                </div>
                                         </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($employees as $employee)
                                        <tr class="hover:bg-gray-50 transition-all duration-200">
                                            <td class="py-2 px-3 border-r border-b border-gray-200 bg-white">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                                        <span class="text-blue-600 font-semibold">{{ substr($employee->name, 0, 1) }}</span>
                                                    </div>
                                                    <span class="font-medium text-gray-900">{{ $employee->name }}</span>
                                                </div>
                                            </td>
                                            @foreach($dates[0] as $day)
                                                @php
                                                    $schedule = $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first();
                                                    $shift = $schedule ? $schedule->shift : null;
                                                    
                                                    // Definir clases según el turno
                                                    $shiftClasses = [
                                                        'MT' => 'bg-blue-500 text-white',
                                                        'TT' => 'bg-indigo-500 text-white',
                                                        'NT' => 'bg-purple-500 text-white',
                                                        'VC' => 'bg-green-500 text-white',
                                                        'BM' => 'bg-red-500 text-white',
                                                        'PM' => 'bg-yellow-500 text-white',
                                                        'FM' => 'bg-orange-500 text-white',
                                                        'FT' => 'bg-teal-500 text-white',
                                                        'AP' => 'bg-pink-500 text-white',
                                                        'DL' => 'bg-lime-500 text-white',
                                                    ];
                                                    
                                                    $bgClass = $shift ? ($shiftClasses[$shift] ?? 'bg-gray-200 text-gray-700') : 'bg-gray-100 text-gray-400';
                                                @endphp
                                                <td class="py-2 px-3 border-r border-b border-gray-200">
                                                    <div class="flex items-center justify-center">
                                                        <div class="w-10 h-10 rounded-lg {{ $bgClass }} flex items-center justify-center font-bold shadow-sm">
                                                            {{ $shift ?: '--' }}
                                                        </div>
                                                    </div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    @include('schedules._legend-modal')

    <script>
        function showLegend() {
            document.getElementById('legendModal').classList.remove('hidden');
        }

        function hideLegend() {
            document.getElementById('legendModal').classList.add('hidden');
        }
    </script>
</x-app-layout>
