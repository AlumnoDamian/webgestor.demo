<!-- Tablas de horarios por semanas -->
@if(count($employees) > 0)
    @foreach($dates as $weekIndex => $week)
        <div class="week-table {{ $weekIndex === 0 ? 'block' : 'hidden' }}" data-week="{{ $weekIndex }}">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Encabezado mejorado -->
                <div
                    class="bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 py-3 pl-3 flex items-center">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/10 rounded-lg p-2">
                            <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 2V5" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16 2V5" stroke="currentColor" stroke-width="1.5"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3.5 9.09H20.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                <path
                                    d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white text-base font-semibold tracking-wide">
                                Semana {{ $weekIndex + 1 }}
                            </h3>
                            <p class="text-blue-100 text-sm">
                                {{ $week[0]['dayNumber'] }} {{ $week[0]['month'] }} -
                                {{ $week[6]['dayNumber'] }} {{ $week[6]['month'] }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-b from-gray-50 to-gray-100">
                            <tr>
                                <th
                                    class="py-3 px-4 text-left text-xs font-medium text-gray-600 uppercase tracking-wider w-48 border-r border-gray-200">
                                    <div class="flex items-center space-x-2">
                                        <div
                                            class="w-7 h-7 rounded-full bg-blue-100/50 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600" viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M20.5899 22C20.5899 18.13 16.7399 15 11.9999 15C7.25991 15 3.40991 18.13 3.40991 22"
                                                    stroke="currentColor" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <span>Empleado</span>
                                    </div>
                                </th>
                                @foreach($week as $day)
                                    <th
                                        class="py-3 px-4 text-left font-medium border-r border-gray-200 {{ $loop->last ? '' : 'border-r' }}">
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="text-sm text-gray-600 font-semibold tracking-wide min-w-[40px]">{{ $day['dayName'] }}</span>
                                            <div class="flex items-center bg-blue-50 rounded px-2 py-0.5">
                                                <span
                                                    class="text-sm font-bold text-blue-600">{{ $day['dayNumber'] }}</span>
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
                                            <div
                                                class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                                <span
                                                    class="text-blue-600 font-semibold">{{ substr($employee->name, 0, 1) }}</span>
                                            </div>
                                            <span class="font-medium text-gray-900">{{ $employee->name }}</span>
                                        </div>
                                    </td>
                                    @foreach($week as $day)
                                        @php
                                            $date = $day['date'];
                                            $isPastDay = \Carbon\Carbon::parse($date)->isPast() && !\Carbon\Carbon::parse($date)->isToday();
                                        @endphp
                                        <td
                                            class="py-2 px-3 border-r border-b border-gray-200 bg-white hover:bg-blue-50/50 transition-all duration-200">
                                            <div class="relative">
                                                <div
                                                    class="absolute -inset-px rounded border {{ $isPastDay ? 'border-gray-300 bg-gray-300' : 'border-blue-100 hover:border-blue-200' }} transition-all duration-200 pointer-events-none">
                                                </div>
                                                <select name="schedules[{{ $employee->id }}][{{ $day['date'] }}]" {{ $isPastDay ? 'disabled' : '' }}
                                                    class="relative block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm text-sm 
                                                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                                                transition-all duration-200
                                                                {{ $isPastDay ? 'text-gray-300' : '' }}
                                                                {{ \Carbon\Carbon::parse($date)->isToday() ? 'border-blue-500 ring-2 ring-blue-200' : '' }}">
                                                    <option value="">--</option>
                                                    <option value="MT" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "MT" && !$isPastDay ? 'selected' : '' }}>
                                                        MT
                                                    </option>
                                                    <option value="TT" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "TT" && !$isPastDay ? 'selected' : '' }}>
                                                        TT
                                                    </option>
                                                    <option value="NT" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "NT" && !$isPastDay ? 'selected' : '' }}>
                                                        NT
                                                    </option>
                                                    <option value="VC" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "VC" && !$isPastDay ? 'selected' : '' }}>
                                                        VC
                                                    </option>
                                                    <option value="BM" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "BM" && !$isPastDay ? 'selected' : '' }}>
                                                        BM
                                                    </option>
                                                    <option value="PM" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "PM" && !$isPastDay ? 'selected' : '' }}>
                                                        PM
                                                    </option>
                                                    <option value="FM" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "FM" && !$isPastDay ? 'selected' : '' }}>
                                                        FM
                                                    </option>
                                                    <option value="FT" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "FT" && !$isPastDay ? 'selected' : '' }}>
                                                        FT
                                                    </option>
                                                    <option value="AP" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "AP" && !$isPastDay ? 'selected' : '' }}>
                                                        AP
                                                    </option>
                                                    <option value="DL" {{ $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first() && $schedules->where('employee_id', $employee->id)->where('day', $day['date'])->first()->shift == "DL" && !$isPastDay ? 'selected' : '' }}>
                                                        DL
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
@else
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 py-3 pl-3">
            <div class="flex items-center space-x-3">
                <div class="bg-white/10 rounded-lg p-2">
                    <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 8V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.995 16H12.004" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3 class="text-white text-base font-semibold tracking-wide">
                    Atención
                </h3>
            </div>
        </div>
        <div class="p-6">
            <div class="flex flex-col items-center justify-center text-center space-y-4">
                <div class="bg-blue-50 rounded-full p-4">
                    <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-1">No hay empleados asignados</h3>
                    <p class="text-gray-600">Este departamento no tiene empleados asignados actualmente. Asigna empleados para poder gestionar sus horarios.</p>
                </div>
                <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Gestionar Empleados
                </a>
            </div>
        </div>
    </div>
@endif