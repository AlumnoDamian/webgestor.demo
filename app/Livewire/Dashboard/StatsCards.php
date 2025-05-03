<?php

namespace App\Livewire\Dashboard;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Memo;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatsCards extends Component
{
    public function getStats()
    {
        return [
            'empleados' => [
                'count' => Employee::count(),
                'active' => Employee::where('is_active', true)->count(),
                'trend' => $this->calculateTrend(Employee::class),
                'icon' => 'users',
                'color' => 'blue'
            ],
            'departamentos' => [
                'count' => Department::count(),
                'active' => Department::count(),
                'trend' => 0,
                'icon' => 'building',
                'color' => 'green'
            ],
            'comunicados' => [
                'count' => Memo::count(),
                'recent' => Memo::count(),
                'trend' => $this->calculateTrend(Memo::class),
                'icon' => 'file-alt',
                'color' => 'yellow'
            ]
        ];
    }

    private function calculateTrend($model)
    {
        $now = Carbon::now();
        $lastMonth = $now->copy()->subMonth();
        
        $currentCount = $model::whereBetween('created_at', [
            $now->copy()->startOfMonth(),
            $now->copy()->endOfMonth()
        ])->count();

        $lastMonthCount = $model::whereBetween('created_at', [
            $lastMonth->copy()->startOfMonth(),
            $lastMonth->copy()->endOfMonth()
        ])->count();

        if ($lastMonthCount == 0) return 0;
        
        return (($currentCount - $lastMonthCount) / $lastMonthCount) * 100;
    }

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
        $employee = $this->getCurrentEmployee();
        $startDate = optional($employee)->start_date ? Carbon::parse($employee->start_date) : null;

        return view('livewire.dashboard.stats-cards', [
            'stats' => $this->getStats(),
            'currentEmployee' => $employee,
            'employeeData' => $employee ? [
                'antiguedad' => $startDate ? $startDate->diffForHumans() : 'N/A',
                'dias_empresa' => $startDate ? $startDate->diffInDays(Carbon::now()) : 0,
                'fecha_inicio' => $startDate ? $startDate->format('d/m/Y') : 'N/A',
                'estado' => $employee->is_active ? 'Activo' : 'Inactivo',
                'tipo_contrato' => $employee->contract_type ?? 'No especificado',
                'horario' => $employee->schedule ?? 'No especificado',
            ] : null
        ]);
    }
}
