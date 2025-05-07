<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Employee;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        try {
            $schedules = $request->input('schedules');

            if (empty($schedules)) {
                return response()->json([
                    'message' => 'No se recibieron horarios para guardar'
                ], 400);
            }

            DB::beginTransaction();

            // Agrupar horarios por empleado
            $schedulesByEmployee = collect($schedules)->groupBy('employee_id');

            foreach ($schedulesByEmployee as $employeeId => $employeeSchedules) {
                // Eliminar horarios existentes para el empleado
                Schedule::where('employee_id', $employeeId)->delete();

                // Crear nuevos horarios
                foreach ($employeeSchedules as $schedule) {
                    Schedule::create([
                        'employee_id' => $employeeId,
                        'day_of_week' => $schedule['day_of_week'],
                        'start_time' => $schedule['start_time'],
                        'end_time' => $schedule['end_time']
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Horarios guardados correctamente'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al guardar los horarios',
                'error' => $e->getMessage()
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
