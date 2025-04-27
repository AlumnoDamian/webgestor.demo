<x-app-layout>
<div class="py-10">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-16">
            <form action="{{ route('cuadrante.store') }}" method="POST" id="scheduleForm">
                @csrf
                <!-- Header con selector de departamento y botón guardar -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-6 mb-8">
                    <div class="w-full sm:w-[24rem]">
                        <select name="department_id" id="department_id" 
                            class="block w-full py-3 px-4 text-base border border-gray-300 bg-white rounded-lg shadow-sm
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                transition-all duration-200 hover:border-blue-400"
                            onchange="window.location.href='{{ route('cuadrante.show') }}?department_id=' + this.value">
                            <option value="">Seleccionar departamento</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" 
                                    {{ request('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    @if(request('department_id'))
                        <button type="submit" 
                            class="group inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 
                                border-0 rounded-lg font-semibold text-base text-white tracking-wide shadow-md
                                hover:from-blue-700 hover:via-indigo-700 hover:to-indigo-800 
                                focus:outline-none focus:ring-2 focus:ring-blue-500/50
                                active:from-blue-800 active:via-indigo-800 active:to-indigo-900
                                transition-all duration-200 ease-in-out
                                min-w-[200px] transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8V12L14.5 14.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.25 12C5.25 8.27208 8.27208 5.25 12 5.25C15.7279 5.25 18.75 8.27208 18.75 12C18.75 15.7279 15.7279 18.75 12 18.75C8.27208 18.75 5.25 15.7279 5.25 12Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M12 2.75V4.25" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M21.25 12L19.75 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 19.75V21.25" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.25 12L2.75 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="relative">
                                Guardar horario
                                <span class="absolute -bottom-0.5 left-0 w-full h-0.5 bg-white/30 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </span>
                        </button>
                    @endif
                </div>

                @if(!isset($employees) || $employees->count() == 0)
                    <!-- Mensaje cuando no hay empleados -->
                    <div class="mt-6 p-8 bg-gradient-to-br from-yellow-50 via-amber-50 to-orange-50 rounded-xl shadow-lg border border-yellow-200/50 relative overflow-hidden">
                        <!-- Elementos decorativos -->
                        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-yellow-200/20 to-amber-300/20 rounded-full -translate-y-48 translate-x-48 blur-3xl"></div>
                        <div class="absolute bottom-0 left-0 w-72 h-72 bg-gradient-to-tr from-orange-200/20 to-yellow-300/20 rounded-full translate-y-36 -translate-x-36 blur-3xl"></div>
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full bg-gradient-to-r from-yellow-100/10 via-transparent to-amber-100/10 rounded-full blur-2xl"></div>
                        
                        <div class="relative flex items-start space-x-8">
                            <!-- Columna del icono -->
                            <div class="flex flex-col items-center space-y-6">
                                <div class="flex-shrink-0 bg-gradient-to-br from-amber-400 to-yellow-500 p-5 rounded-xl shadow-lg transform -rotate-6 hover:rotate-0 transition-all duration-300 group">
                                    <svg class="w-12 h-12 text-white transform group-hover:scale-110 transition-transform" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 8V13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M12 16.5V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                </div>
                                <div class="h-full w-0.5 bg-gradient-to-b from-amber-200 via-yellow-200 to-transparent rounded-full"></div>
                            </div>

                            <!-- Columna del contenido -->
                            <div class="flex-1">
                                <div class="bg-white/60 backdrop-blur-lg rounded-xl p-6 shadow-sm border border-yellow-100/50">
                                    <div class="flex items-center space-x-3 mb-4">
                                        <h3 class="text-2xl font-bold bg-gradient-to-r from-amber-600 to-yellow-600 bg-clip-text text-transparent">
                                            Selecciona un departamento
                                        </h3>
                                        <span class="px-3 py-1 text-sm font-medium text-amber-700 bg-gradient-to-r from-amber-100 to-yellow-100 rounded-full shadow-sm border border-amber-200/50">
                                            Paso necesario
                                        </span>
                                    </div>
                                    
                                    <p class="text-amber-800 mb-8 leading-relaxed">
                                        Para gestionar los horarios, primero necesitas seleccionar un departamento del menú desplegable superior. Esto te permitirá:
                                    </p>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                                        <div class="group bg-gradient-to-br from-white to-amber-50/50 p-4 rounded-xl border border-yellow-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                            <div class="flex items-center space-x-3 text-amber-700 mb-2">
                                                <div class="p-2 rounded-lg bg-gradient-to-br from-amber-100 to-yellow-100 group-hover:from-amber-200 group-hover:to-yellow-200 transition-colors duration-300">
                                                    <svg class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none">
                                                        <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <span class="font-semibold group-hover:text-amber-800 transition-colors">Ver empleados</span>
                                            </div>
                                            <p class="text-amber-600 text-sm pl-10 group-hover:text-amber-700 transition-colors">Accede a la lista completa del personal asignado</p>
                                        </div>

                                        <div class="group bg-gradient-to-br from-white to-amber-50/50 p-4 rounded-xl border border-yellow-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                            <div class="flex items-center space-x-3 text-amber-700 mb-2">
                                                <div class="p-2 rounded-lg bg-gradient-to-br from-amber-100 to-yellow-100 group-hover:from-amber-200 group-hover:to-yellow-200 transition-colors duration-300">
                                                    <svg class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none">
                                                        <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <span class="font-semibold group-hover:text-amber-800 transition-colors">Gestionar turnos</span>
                                            </div>
                                            <p class="text-amber-600 text-sm pl-10 group-hover:text-amber-700 transition-colors">Organiza los turnos semanales eficientemente</p>
                                        </div>

                                        <div class="group bg-gradient-to-br from-white to-amber-50/50 p-4 rounded-xl border border-yellow-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                            <div class="flex items-center space-x-3 text-amber-700 mb-2">
                                                <div class="p-2 rounded-lg bg-gradient-to-br from-amber-100 to-yellow-100 group-hover:from-amber-200 group-hover:to-yellow-200 transition-colors duration-300">
                                                    <svg class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none">
                                                        <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <span class="font-semibold group-hover:text-amber-800 transition-colors">Planificar horarios</span>
                                            </div>
                                            <p class="text-amber-600 text-sm pl-10 group-hover:text-amber-700 transition-colors">Establece los horarios de manera flexible</p>
                                        </div>

                                        <div class="group bg-gradient-to-br from-white to-amber-50/50 p-4 rounded-xl border border-yellow-100 shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                            <div class="flex items-center space-x-3 text-amber-700 mb-2">
                                                <div class="p-2 rounded-lg bg-gradient-to-br from-amber-100 to-yellow-100 group-hover:from-amber-200 group-hover:to-yellow-200 transition-colors duration-300">
                                                    <svg class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none">
                                                        <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/>
                                                    </svg>
                                                </div>
                                                <span class="font-semibold group-hover:text-amber-800 transition-colors">Visualizar calendario</span>
                                            </div>
                                            <p class="text-amber-600 text-sm pl-10 group-hover:text-amber-700 transition-colors">Vista completa del calendario semanal</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between pt-4 border-t border-yellow-100">
                                        <div class="flex items-center space-x-2">
                                            <div class="p-2 rounded-lg bg-gradient-to-br from-amber-100 to-yellow-100">
                                                <svg class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 16V12L10 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/>
                                                </svg>
                                            </div>
                                            <span class="text-sm font-medium text-amber-700">Selecciona un departamento para comenzar</span>
                                        </div>
                                        <div class="flex items-center text-amber-600 text-sm font-medium bg-gradient-to-r from-amber-50 to-yellow-50 px-4 py-2 rounded-lg shadow-sm border border-amber-100">
                                            <svg class="w-4 h-4 mr-2 animate-bounce" viewBox="0 0 24 24" fill="none">
                                                <path d="M12 16L12 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                <path d="M9 11L12 8L15 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            Usar el menú superior
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Botones de selección de semana -->
                    <div class="flex flex-wrap gap-3 mb-6">
                        @foreach($dates as $weekIndex => $week)
                            @php
                                $startDate = \Carbon\Carbon::parse($week[0]['date']);
                                $endDate = \Carbon\Carbon::parse($week[6]['date']);
                                $isCurrentWeek = $weekIndex === 0;
                            @endphp
                            <button type="button" 
                                data-week="{{ $weekIndex }}"
                                class="week-selector group relative flex-1 min-w-[200px] max-w-[250px] px-4 py-3 
                                    rounded-lg border shadow-sm transition-all duration-300 ease-in-out
                                    {{ $isCurrentWeek 
                                        ? 'bg-gradient-to-b from-blue-50 to-blue-100 border-blue-300 shadow-inner' 
                                        : 'bg-gradient-to-b from-white to-gray-50 border-gray-200 hover:border-blue-400 hover:from-blue-50 hover:to-white hover:shadow-md hover:-translate-y-0.5' }}
                                    focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0 relative">
                                            <div class="absolute inset-0 bg-blue-100 rounded-lg transform -rotate-6 transition-transform group-hover:rotate-6"></div>
                                            <svg class="relative w-6 h-6 text-blue-600 transform transition-transform group-hover:scale-110" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 2V5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 2V5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M3.5 9.09H20.5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <circle cx="12" cy="13" r="1" fill="currentColor"/>
                                            </svg>
                                        </div>
                                        <div class="flex flex-col items-start">
                                            <span class="text-xs font-medium text-blue-600 bg-white/80 px-2 py-0.5 rounded-full mb-0.5 shadow-sm">
                                                Semana {{ $weekIndex + 1 }}
                                            </span>
                                            <span class="text-sm font-semibold {{ $isCurrentWeek ? 'text-blue-800' : 'text-gray-800 group-hover:text-blue-700' }}">
                                                {{ $startDate->format('d') }} 
                                                {{ $startDate->format('M') != $endDate->format('M') ? $startDate->format('M') : '' }} 
                                                - {{ $endDate->format('d M') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="transform transition-all duration-300 group-hover:translate-x-1">
                                        <svg class="w-5 h-5 {{ $isCurrentWeek ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.91016 19.92L15.4302 13.4C16.2002 12.63 16.2002 11.37 15.4302 10.6L8.91016 4.07999" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                </div>
                                <!-- Barra de progreso solo visible en semana activa -->
                                @if($isCurrentWeek)
                                <div class="absolute left-0 right-0 bottom-0 h-0.5 overflow-hidden rounded-b-lg">
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600
                                        transform origin-left scale-x-100
                                        transition-transform duration-500 ease-out"></div>
                                </div>
                                @endif
                            </button>
                        @endforeach
                    </div>

                    <!-- Tablas de horarios por semanas -->
                    @foreach($dates as $weekIndex => $week)
                        <div class="week-table {{ $weekIndex === 0 ? 'block' : 'hidden' }}" data-week="{{ $weekIndex }}">
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <!-- Encabezado mejorado -->
                                <div class="bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 py-3 pl-3 flex items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-white/10 rounded-lg p-2">
                                            <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 2V5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16 2V5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M3.5 9.09H20.5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-white text-base font-semibold tracking-wide">
                                                Semana {{ $weekIndex + 1 }}
                                            </h3>
                                            <p class="text-blue-100 text-sm">
                                                {{ $week[0]['dayNumber'] }} {{ $week[0]['month'] }} - {{ $week[6]['dayNumber'] }} {{ $week[6]['month'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gradient-to-b from-gray-50 to-gray-100">
                                            <tr>
                                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider w-48 border-r border-gray-200">
                                                    <div class="flex items-center space-x-2">
                                                        <div class="w-7 h-7 rounded-full bg-blue-100/50 flex items-center justify-center">
                                                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </div>
                                                        <span>Empleado</span>
                                                    </div>
                                                </th>
                                                @foreach($week as $day)
                                                    <th class="py-3 px-4 text-left font-medium border-r border-gray-200 {{ $loop->last ? '' : 'border-r' }}">
                                                        <div class="flex items-center space-x-2">
                                                            <span class="text-sm text-gray-600 font-semibold tracking-wide min-w-[40px]">{{ $day['dayName'] }}</span>
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
                                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                                    <td class="py-2 px-3 border-r border-b border-gray-200 bg-white">
                                                        <div class="flex items-center">
                                                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                                                <span class="text-blue-600 font-semibold">{{ substr($employee->name, 0, 1) }}</span>
                                                            </div>
                                                            <span class="font-medium text-gray-900">{{ $employee->name }}</span>
                                                        </div>
                                                    </td>
                                                    @foreach($week as $day)
                                                        @php
                                                            $date = $day['date'];
                                                            $isPastDay = \Carbon\Carbon::parse($date)->isPast() && !\Carbon\Carbon::parse($date)->isToday();
                                                        @endphp
                                                        <td class="py-2 px-3 border-r border-b border-gray-200 bg-white hover:bg-blue-50/50 transition-colors duration-200">
                                                            <div class="relative">
                                                                <div class="absolute -inset-px rounded border {{ $isPastDay ? 'border-gray-300 bg-gray-300' : 'border-blue-100 hover:border-blue-200' }} transition-colors duration-200 pointer-events-none"></div>
                                                                <select name="schedules[{{ $employee->id }}][{{ $day['date'] }}]"
                                                                    {{ $isPastDay ? 'disabled' : '' }}
                                                                    class="relative block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm text-sm 
                                                                        focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                                                        transition-all duration-200
                                                                        {{ $isPastDay ? 'text-gray-300' : '' }}
                                                                        {{ \Carbon\Carbon::parse($date)->isToday() ? 'border-blue-500 ring-2 ring-blue-200' : '' }}">
                                                                    <option value="">Sin turno</option>
                                                                    <option value="08:00 - 16:00" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "08:00 - 16:00" && !$isPastDay ? 'selected' : '' }}>
                                                                        Mañana (08:00 - 16:00)
                                                                    </option>
                                                                    <option value="16:00 - 00:00" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "16:00 - 00:00" && !$isPastDay ? 'selected' : '' }}>
                                                                        Tarde (16:00 - 00:00)
                                                                    </option>
                                                                    <option value="00:00 - 08:00" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "00:00 - 08:00" && !$isPastDay ? 'selected' : '' }}>
                                                                        Noche (00:00 - 08:00)
                                                                    </option>
                                                                    <option value="Vacaciones" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "Vacaciones" && !$isPastDay ? 'selected' : '' }}>
                                                                        Vacaciones
                                                                    </option>
                                                                    <option value="Baja Médica" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "Baja Médica" && !$isPastDay ? 'selected' : '' }}>
                                                                        Baja Médica
                                                                    </option>
                                                                    <option value="Permiso" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "Permiso" && !$isPastDay ? 'selected' : '' }}>
                                                                        Permiso
                                                                    </option>
                                                                    <option value="Formación" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "Formación" && !$isPastDay ? 'selected' : '' }}>
                                                                        Formación
                                                                    </option>
                                                                    <option value="Festivo" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "Festivo" && !$isPastDay ? 'selected' : '' }}>
                                                                        Festivo
                                                                    </option>
                                                                    <option value="Asuntos Propios" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "Asuntos Propios" && !$isPastDay ? 'selected' : '' }}>
                                                                        Asuntos Propios
                                                                    </option>
                                                                </select>
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
                    @endforeach
                @endif
            </form>
        </div>
    </div>

    <!-- Scripts para la interactividad -->
    <script>
        function showWeek(weekIndex) {
            // Ocultar todas las tablas
            document.querySelectorAll('.week-table').forEach(table => {
                table.classList.add('hidden');
            });
            
            // Mostrar la tabla seleccionada
            document.querySelector(`.week-table[data-week="${weekIndex}"]`).classList.remove('hidden');
            
            // Actualizar los botones
            document.querySelectorAll('.week-selector').forEach(button => {
                // Remover estilos activos
                button.classList.remove('from-blue-50', 'to-blue-100', 'border-blue-300', 'shadow-inner');
                button.classList.add('from-white', 'to-gray-50', 'border-gray-200', 'hover:-translate-y-0.5', 'hover:shadow-md');
                
                // Actualizar textos y elementos internos
                const dateText = button.querySelector('span:last-child');
                const arrow = button.querySelector('svg:last-child');
                if (dateText) dateText.classList.remove('text-blue-800');
                if (arrow) arrow.classList.remove('text-blue-600');
                
                // Manejar la barra de progreso
                const existingBar = button.querySelector('.absolute.bottom-0');
                if (existingBar) existingBar.remove();
                
                if (button.dataset.week == weekIndex) {
                    // Aplicar estilos activos
                    button.classList.remove('from-white', 'to-gray-50', 'border-gray-200', 'hover:-translate-y-0.5', 'hover:shadow-md');
                    button.classList.add('from-blue-50', 'to-blue-100', 'border-blue-300', 'shadow-inner');
                    
                    // Actualizar textos y elementos internos
                    if (dateText) dateText.classList.add('text-blue-800');
                    if (arrow) arrow.classList.add('text-blue-600');
                    
                    // Agregar barra de progreso
                    const progressBar = document.createElement('div');
                    progressBar.className = 'absolute left-0 right-0 bottom-0 h-0.5 overflow-hidden rounded-b-lg';
                    progressBar.innerHTML = `
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600
                            transform origin-left scale-x-100
                            transition-transform duration-500 ease-out"></div>
                    `;
                    button.appendChild(progressBar);
                }
            });
        }

        // Inicializar la primera semana al cargar
        document.addEventListener('DOMContentLoaded', function() {
            showWeek(0);

            // Añadir event listener para el formulario (solo para guardar horarios)
            document.getElementById('scheduleForm').addEventListener('submit', function(e) {
                // Solo prevenir el submit si el botón presionado es el de guardar
                if (e.submitter && e.submitter.type === 'submit') {
                    e.preventDefault();
                    
                    // Enviar el formulario usando fetch
                    fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': new FormData(this).get('_token'),
                            'Accept': 'application/json',
                        },
                        body: new FormData(this)
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Recargar la página después de guardar
                        window.location.reload();
                    })
                    .catch(error => {
                        alert('Error al guardar los cambios. Por favor, inténtelo de nuevo.');
                    });
                }
            });

            // Añadir event listeners para los selects
            document.querySelectorAll('select[name^="schedules"]').forEach(select => {
                select.addEventListener('change', function() {
                    // El select cambió, pero no necesitamos hacer nada específico aquí
                });
            });

            // Añadir event listeners para los botones de semana
            document.querySelectorAll('.week-selector').forEach(button => {
                button.addEventListener('click', function() {
                    showWeek(this.dataset.week);
                });
            });
        });
    </script>
</x-app-layout>