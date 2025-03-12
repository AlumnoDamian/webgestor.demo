@extends('layouts.layout')

@section('content')
<div class="container-fluid container-custom">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-0 shadow-sm p-2">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted hover-text-primary transition-all duration-300">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cuadrante de los departamentos</li>
        </ol>
    </nav>
    <h1 class="text-3xl font-bold mb-6 text-blue-600">Cuadrante de los departamentos</h1>

    <!-- Formulario para seleccionar el departamento -->
    <form action="{{ route('cuadrante.show') }}" method="GET" class="mb-6">
        <div class="flex items-center space-x-4">
            <label for="department_id" class="text-lg text-gray-700 font-medium">Selecciona un departamento:</label>
            <div class="relative">
                <select name="department_id" id="department_id" class="select-department p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out w-80" onchange="this.form.submit()" required>
                    <option value="">Departamento no seleccionado</option> <!-- Cambié el texto aquí -->
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" 
                            {{ request()->input('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                <!-- Flecha personalizada si es necesario (puede eliminarse para ocultarla completamente) -->
                <div class="absolute top-0 right-0 p-3 pointer-events-none">
                    <i class="fas fa-chevron-down text-gray-400"></i>
                </div>
            </div>
        </div>
    </form>

    @if(!isset($employees) || $employees->count() == 0)
        <!-- Mensaje cuando no hay empleados o no se ha seleccionado un departamento -->
        <div class="mt-6 p-6 bg-yellow-200 border-l-4 border-yellow-500 rounded-lg shadow-lg transition-all duration-500 ease-in-out transform hover:scale-105 hover:shadow-xl hover:bg-yellow-300">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-3xl text-yellow-500 mr-4"></i>
                <div>
                    <h2 class="font-semibold text-xl text-gray-800">¡Atención! Es necesario seleccionar un departamento</h2>
                    <p class="mt-2 text-gray-700">Para poder visualizar el cuadrante de horarios, es imprescindible seleccionar un departamento de la lista desplegable. Si no se han asignado empleados a este departamento, lamentablemente no se podrá mostrar ningún dato relacionado con los horarios de trabajo.</p>
                    <p class="mt-2 text-gray-700">Si el departamento seleccionado no tiene empleados asignados o si aún no se ha configurado el cuadrante de horarios, no será posible acceder a la información relevante. Le recomendamos verificar que todos los departamentos cuenten con los empleados necesarios y que se hayan configurado adecuadamente sus horarios.</p>
                    <p class="mt-2 text-gray-600 font-medium">Por favor, proceda seleccionando un departamento de la lista para continuar con la visualización de los horarios.</p>
                </div>
            </div>
        </div>
    @else
        <!-- Tabla de horarios de los empleados -->
        <form action="{{ route('cuadrante.store') }}" method="POST">
            @csrf
            <div class="overflow-x-auto mt-6 animate__animated animate__fadeIn">
                <table class="w-full border-collapse border border-gray-300 shadow-md rounded-lg">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="border p-3">Empleado</th>
                            @foreach($days as $day)
                                <th class="border p-3">{{ $day }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                            <tr class="transition duration-300 hover:bg-gray-100">
                                <td class="border p-3">{{ $employee->name }}</td>
                                @foreach($days as $day)
                                    @php
                                        $schedule = $schedules->where('employee_id', $employee->id)->where('day', $day)->first();
                                    @endphp
                                    <td class="border">
                                        <div class="relative w-full">
                                            <select name="schedules[{{ $employee->id }}][{{ $day }}]" class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-500 appearance-none">
                                                <option value="">Sin turno</option>
                                                <option value="08:00 - 16:00" {{ $schedule && $schedule->shift == "08:00 - 16:00" ? 'selected' : '' }}>Mañana (08:00 - 16:00)</option>
                                                <option value="16:00 - 00:00" {{ $schedule && $schedule->shift == "16:00 - 00:00" ? 'selected' : '' }}>Tarde (16:00 - 00:00)</option>
                                                <option value="00:00 - 08:00" {{ $schedule && $schedule->shift == "00:00 - 08:00" ? 'selected' : '' }}>Noche (00:00 - 08:00)</option>
                                            </select>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <button type="submit" class="mt-6 bg-blue-600 text-white px-6 py-3 rounded-md shadow-lg transition duration-300 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-500">
                Guardar horarios
            </button>
        </form>
    @endif
</div>
@endsection
