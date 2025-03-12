@extends('layouts.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Cuadrante de Horarios</h1>

    <form action="{{ route('cuadrante.store') }}" method="POST">
        @csrf
        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">Empleado</th>
                        @foreach($days as $day)
                            <th class="border p-2">{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td class="border p-2">{{ $employee->name }}</td>
                            @foreach($days as $day)
                                @php
                                    $schedule = $schedules->where('employee_id', $employee->id)->where('day', $day)->first();
                                @endphp
                                <td class="border p-2">
                                    <select name="schedules[{{ $employee->id }}][{{ $day }}]" class="p-1 border w-full">
                                        <option value="">Sin turno</option>
                                        <option value="08:00 - 16:00" {{ $schedule && $schedule->shift == "08:00 - 16:00" ? 'selected' : '' }}>Mañana (08:00 - 16:00)</option>
                                        <option value="16:00 - 00:00" {{ $schedule && $schedule->shift == "16:00 - 00:00" ? 'selected' : '' }}>Tarde (16:00 - 00:00)</option>
                                        <option value="00:00 - 08:00" {{ $schedule && $schedule->shift == "00:00 - 08:00" ? 'selected' : '' }}>Noche (00:00 - 08:00)</option>
                                    </select>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">
            Guardar horario
        </button>
    </form>
</div>
@endsection
