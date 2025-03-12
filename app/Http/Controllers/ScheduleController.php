<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Employee;
use App\Models\Department;


class ScheduleController extends Controller
{
    public function show(Request $request)
    {
        $departments = Department::all();
        $departmentId = $request->input('department_id');

        if (!$departmentId) {
            return view('schedules.index', [
                'departments' => $departments,
                'employees' => collect(), // Colección vacía para evitar errores
                'schedules' => collect(), // Colección vacía para evitar errores
                'days' => ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']
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
            'days' => ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo']
        ]);
    }


    public function store(Request $request)
    {
        foreach ($request->schedules as $employeeId => $scheduleData) {
            foreach ($scheduleData as $day => $shift) {
                Schedule::updateOrCreate(
                    ['employee_id' => $employeeId, 'day' => $day],
                    ['shift' => $shift]
                );
            }
        }

        return redirect()->back()->with('success', 'Horario guardado correctamente');
    }
}
