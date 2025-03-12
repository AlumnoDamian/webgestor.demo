<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        // Obtener todos los departamentos
        $departments = Department::all();

        // Retornar la vista con los datos necesarios
        return view('dashboard', compact('employee', 'departments'));
    }
}
