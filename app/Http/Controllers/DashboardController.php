<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Memo;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado
        $employee = Employee::where('user_id', Auth::id())->firstOrFail();

        // Obtener todos los departamentos
        $departments = Department::all();

        // Obtener los últimos comunicados (puedes limitar la cantidad si quieres)
        $communications = Memo::latest()->take(3)->get();

        // Retornar la vista con los datos necesarios
        return view('dashboard', compact('employee', 'departments', 'communications'));
    }
}
