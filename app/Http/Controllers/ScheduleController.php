<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Employee;

class ScheduleController extends Controller
{
    public function index() {
        $employees = Employee::all();
        $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        $schedules = Schedule::all();
        return view('schedules.index', compact('employees', 'days', 'schedules'));
    }

    public function store(Request $request) {
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
