@props(['departments', 'selectedDepartment', 'employees'])

<!-- Header con selector de departamento y botón guardar -->
<div class="flex flex-col sm:flex-row items-center justify-between gap-6 mb-8">
    <div class="w-full sm:w-[24rem]">
        <select name="department_id" id="department_id"
            class="block w-full py-3 px-4 text-base border border-gray-300 bg-white rounded-lg shadow-sm
                                focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                                transition-all duration-200 hover:border-blue-400 hover:from-blue-50 hover:to-white hover:shadow-md hover:-translate-y-0.5"
            onchange="window.location.href='{{ route('cuadrante.show') }}?department_id=' + this.value">
            <option value="">Seleccionar departamento</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </div>

    @if(request('department_id'))
        <div class="flex justify-end space-x-4 mt-6">
            <button type="submit" class="group inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 
                                        border-0 rounded-lg font-semibold text-base text-white tracking-wide shadow-md
                                        hover:from-blue-700 hover:via-indigo-700 hover:to-indigo-800 
                                        focus:outline-none focus:ring-2 focus:ring-blue-500/50
                                        active:from-blue-800 active:via-indigo-800 active:to-indigo-900
                                        transition-all duration-200 ease-in-out
                                        min-w-[200px] transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 8V12L14.5 14.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path
                        d="M5.25 12C5.25 8.27208 8.27208 5.25 12 5.25C15.7279 5.25 18.75 8.27208 18.75 12C18.75 15.7279 15.7279 18.75 12 18.75C8.27208 18.75 5.25 15.7279 5.25 12Z"
                        stroke="currentColor" stroke-width="2" />
                    <path d="M12 2.75V4.25" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M21.25 12L19.75 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M12 19.75V21.25" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M4.25 12L2.75 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="relative">
                    Guardar horario
                    <span
                        class="absolute -bottom-0.5 left-0 w-full h-0.5 bg-white/30 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                </span>
            </button>

            <button type="button" onclick="showLegend()" class="group inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600
                                        border-0 rounded-lg font-semibold text-base text-white tracking-wide shadow-md
                                        hover:from-emerald-500 hover:to-teal-500
                                        focus:outline-none focus:ring-2 focus:ring-emerald-500/50
                                        active:from-emerald-600 active:to-teal-600
                                        transition-all duration-200 ease-in-out
                                        min-w-[200px] transform hover:-translate-y-0.5">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 8H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    <path d="M9 12H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    <path d="M9 16H13" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    <path
                        d="M3.5 12C3.5 5.5 5.5 3.5 12 3.5C18.5 3.5 20.5 5.5 20.5 12C20.5 18.5 18.5 20.5 12 20.5C5.5 20.5 3.5 18.5 3.5 12Z"
                        stroke="currentColor" stroke-width="2" />
                </svg>
                <span class="relative">
                    Ver leyenda
                    <span
                        class="absolute -bottom-0.5 left-0 w-full h-0.5 bg-white/30 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                </span>
            </button>
        </div>
    @endif
</div>