<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Employee;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{
    public function show(Request $request)
    {
        $departments = Department::all();
        $departmentId = $request->input('department_id');

        // Generar las fechas para las próximas 4 semanas
        $dates = collect();
        $startDate = Carbon::now()->startOfWeek();
        
        for ($week = 0; $week < 4; $week++) {
            $weekDates = [];
            for ($day = 0; $day < 7; $day++) {
                $currentDate = $startDate->copy()->addWeeks($week)->addDays($day);
                $weekDates[] = [
                    'date' => $currentDate->format('Y-m-d'),
                    'dayName' => ucfirst($currentDate->locale('es')->isoFormat('dddd')),
                    'dayNumber' => $currentDate->format('d'),
                    'month' => ucfirst($currentDate->locale('es')->isoFormat('MMM')),
                ];
            }
            $dates->push($weekDates);
        }

        if (!$departmentId) {
            return view('schedules.index', [
                'departments' => $departments,
                'employees' => collect(),
                'schedules' => collect(),
                'dates' => $dates->toArray(),
            ]);
        }

        $department = Department::with('employees')->find($departmentId);

        if (!$department) {
            return redirect()->route('cuadrante.show')->withErrors('El departamento seleccionado no existe.');
        }

        $employees = $department->employees;
        $schedules = Schedule::whereIn('employee_id', $employees->pluck('id'))->get();
        
        return view('schedules.index', [
            'departments' => $departments,
            'employees' => $employees,
            'schedules' => $schedules,
            'dates' => $dates->toArray(),
        ]);
    }

    public function store(Request $request)
    {
        Log::info('Recibida solicitud de guardar horarios', [
            'request_data' => $request->all(),
            'department_id' => $request->input('department_id')
        ]);

        // Validar que se haya seleccionado un departamento
        if (!$request->has('department_id')) {
            Log::warning('Intento de guardar sin departamento seleccionado');
            return response()->json([
                'error' => 'Debe seleccionar un departamento.'
            ], 422);
        }

        // Si no hay horarios para guardar, registrar y devolver mensaje
        if (!$request->has('schedules')) {
            Log::info('No se recibieron horarios para guardar');
            return response()->json([
                'message' => 'No se han realizado cambios en los horarios.'
            ]);
        }

        try {
            $updatedCount = 0;
            $deletedCount = 0;

            // Guardar los horarios
            foreach ($request->schedules as $employeeId => $scheduleData) {
                Log::info("Procesando horarios para empleado ID: {$employeeId}", [
                    'schedule_data' => $scheduleData
                ]);

                if (is_array($scheduleData)) {
                    foreach ($scheduleData as $date => $shift) {
                        if ($shift) {
                            Schedule::updateOrCreate(
                                ['employee_id' => $employeeId, 'day' => $date],
                                ['shift' => $shift]
                            );
                            $updatedCount++;
                        } else {
                            // Si el turno está vacío, eliminar el registro si existe
                            $deleted = Schedule::where('employee_id', $employeeId)
                                ->where('day', $date)
                                ->delete();
                            if ($deleted) $deletedCount++;
                        }
                    }
                }
            }

            Log::info('Horarios guardados exitosamente', [
                'updated' => $updatedCount,
                'deleted' => $deletedCount
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Horarios guardados correctamente.',
                'stats' => [
                    'updated' => $updatedCount,
                    'deleted' => $deletedCount
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error al guardar horarios', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Error al guardar los horarios: ' . $e->getMessage()
            ], 500);
        }
    }

    public function view(Request $request)
    {
        $department = $request->input('department');
        $today = now();
        
        // Configurar locale para español
        $today->locale('es');
        
        // Si es sábado, mostraremos la siguiente semana
        $startDate = $today->dayOfWeek === 6 ? $today->addWeek()->startOfWeek() : $today->startOfWeek();
        $endDate = $startDate->copy()->endOfWeek();
        
        // Generar array de fechas para la semana
        $dates = collect();
        $weekDates = [];
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $weekDates[] = [
                'date' => $currentDate->format('Y-m-d'),
                'dayName' => ucfirst($currentDate->locale('es')->isoFormat('dddd')),
                'dayNumber' => $currentDate->format('d'),
                'month' => ucfirst($currentDate->locale('es')->isoFormat('MMM')),
            ];
            $currentDate->addDay();
        }
        $dates->push($weekDates);

        $departments = Department::all();

        // Si no hay departamento seleccionado, retornar vista con colecciones vacías
        if (!$department) {
            return view('schedules.view', [
                'departments' => $departments,
                'employees' => collect(),
                'schedules' => collect(),
                'dates' => $dates->toArray(),
                'startDate' => $startDate,
                'endDate' => $endDate
            ]);
        }

        $employees = Employee::where('department_id', $department)->get();
        
        if ($employees->isEmpty()) {
            return view('schedules.view', [
                'departments' => $departments,
                'employees' => collect(),
                'schedules' => collect(),
                'dates' => $dates->toArray(),
                'startDate' => $startDate,
                'endDate' => $endDate
            ]);
        }

        $schedules = Schedule::whereBetween('day', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->whereHas('employee', function ($q) use ($department) {
                $q->where('department_id', $department);
            })->get();

        return view('schedules.view', [
            'employees' => $employees,
            'schedules' => $schedules,
            'departments' => $departments,
            'dates' => $dates->toArray(),
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }
}
