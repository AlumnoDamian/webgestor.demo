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

        // Preparar datos del empleado
        $employeeData = [
            'estado' => $currentEmployee ? ($currentEmployee->is_active ? 'Activo' : 'Inactivo') : 'N/A',
            'edad' => $birthDate ? $birthDate->age : 'N/A',
            'fecha_nacimiento' => $birthDate ? $birthDate->format('d/m/Y') : 'No registrada',
            'antiguedad' => $hireDate ? $hireDate->diffForHumans() : 'N/A',
            'fecha_inicio' => $hireDate ? $hireDate->format('d/m/Y') : 'No registrada',
            'dias_empresa' => $hireDate ? (int)$hireDate->diffInDays(Carbon::now()) : 'N/A'
        ];

        // Total de comunicados del departamento
        $totalMemos = 0;
        if ($currentEmployee && $currentEmployee->department_id) {
            $totalMemos = Memo::whereHas('department', function($query) use ($currentEmployee) {
                $query->where('id', $currentEmployee->department_id);
            })->count();
        }

        // Total de empleados en el departamento
        $departmentEmployees = 0;
        if ($currentEmployee && $currentEmployee->department_id) {
            $departmentEmployees = Employee::where('department_id', $currentEmployee->department_id)->count();
        }

        // Total de empleados activos en el departamento
        $activeEmployees = 0;
        if ($currentEmployee && $currentEmployee->department_id) {
            $activeEmployees = Employee::where('department_id', $currentEmployee->department_id)
                ->where('is_active', true)
                ->count();
        }

        // Total de empleados por rol en el departamento
        $roleDistribution = [];
        if ($currentEmployee && $currentEmployee->department_id) {
            $roleDistribution = Employee::where('department_id', $currentEmployee->department_id)
                ->selectRaw('role, count(*) as count')
                ->groupBy('role')
                ->get()
                ->pluck('count', 'role')
                ->toArray();
        }

        $totalEmployees = array_sum($roleDistribution);
        $percentages = [];
        
        if ($totalEmployees > 0) {
            foreach ($roleDistribution as $role => $count) {
                $percentages[$role] = round(($count / $totalEmployees) * 100);
            }
        }

        // Calculate age data
        $ageData = ['departmentAverage' => 0, 'employeeAge' => 0];
        if ($currentEmployee && $currentEmployee->department_id) {
            // Get employee age
            $ageData['employeeAge'] = $birthDate ? $birthDate->age : 0;
            
            // Calculate department average age
            $departmentAges = Employee::where('department_id', $currentEmployee->department_id)
                ->whereNotNull('birth_date')
                ->get()
                ->map(function ($employee) {
                    return Carbon::parse($employee->birth_date)->age;
                });
            
            $ageData['departmentAverage'] = $departmentAges->count() > 0 ? $departmentAges->average() : 0;
        }

        return view('livewire.dashboard.stats-cards', [
            'currentEmployee' => $currentEmployee,
            'employeeData' => $employeeData,
            'totalMemos' => $totalMemos,
            'departmentEmployees' => $departmentEmployees,
            'activeEmployees' => $activeEmployees,
            'percentages' => $percentages,
            'ageData' => $ageData
        ]);
    }
}
