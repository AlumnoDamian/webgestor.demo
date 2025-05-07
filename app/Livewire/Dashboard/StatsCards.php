<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Memo;
use App\Models\Employee;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatsCards extends Component
{
    public function getCurrentEmployee()
    {
        return Employee::select('employees.*', 'departments.name as department_name', 'departments.description as department_description')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->leftJoin('users', 'employees.user_id', '=', 'users.id')
            ->where('employees.user_id', Auth::id())
            ->first();
    }

    public function render()
    {
        $currentEmployee = $this->getCurrentEmployee();
        $hireDate = $currentEmployee ? Carbon::parse($currentEmployee->hire_date) : null;
        $birthDate = $currentEmployee ? Carbon::parse($currentEmployee->birth_date) : null;

        // Total de comunicados del departamento
        $totalMemos = Memo::whereHas('department', function($query) use ($currentEmployee) {
            $query->where('id', $currentEmployee->department_id);
        })->count();

        // Total de empleados en el departamento
        $departmentEmployees = Employee::where('department_id', $currentEmployee->department_id)->count();

        // Total de empleados activos en el departamento
        $activeEmployees = Employee::where('department_id', $currentEmployee->department_id)
            ->where('is_active', true)
            ->count();

        // Total de empleados por rol en el departamento
        $roleDistribution = Employee::where('department_id', $currentEmployee->department_id)
            ->selectRaw('role, count(*) as count')
            ->groupBy('role')
            ->get()
            ->pluck('count', 'role')
            ->toArray();

        $totalEmployees = array_sum($roleDistribution);
        $percentages = [];
        
        if ($totalEmployees > 0) {
            foreach ($roleDistribution as $role => $count) {
                $percentages[$role] = round(($count / $totalEmployees) * 100);
            }
        }

        return view('livewire.dashboard.stats-cards', [
            'currentEmployee' => $currentEmployee,
            'employeeData' => $currentEmployee ? [
                'antiguedad' => $hireDate ? $hireDate->diffForHumans() : 'N/A',
                'dias_empresa' => $hireDate ? (int)$hireDate->diffInDays(Carbon::now()) : 0,
                'fecha_inicio' => $hireDate ? $hireDate->format('d/m/Y') : 'N/A',
                'estado' => $currentEmployee->is_active ? 'Activo' : 'Inactivo',
                'cargo' => ucfirst($currentEmployee->position ?? 'No especificado'),
                'edad' => $birthDate ? $birthDate->age : 'N/A',
                'fecha_nacimiento' => $birthDate ? $birthDate->format('d/m/Y') : 'N/A'
            ] : null,
            'totalMemos' => $totalMemos,
            'departmentEmployees' => $departmentEmployees,
            'activeEmployees' => $activeEmployees,
            'percentages' => $percentages
        ]);
    }
}
