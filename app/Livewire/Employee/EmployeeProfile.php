<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Memo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EmployeeProfile extends Component
{
    use WithFileUploads;

    public $employee;
    public $newImage;
    public $showEditModal = false;
    public $editData = [];
    public $successMessage = '';
    public $memoStats;
    public $ageData;
    public $roleDistribution;
    public $departmentEmployees;

    public function mount()
    {
        Log::info('Usuario autenticado:', ['user' => auth()->user()]);
        Log::info('ID del usuario:', ['user_id' => auth()->id()]);
        
        $this->employee = auth()->user()->employee;
        Log::info('Empleado encontrado:', ['employee' => $this->employee]);
        
        if (!$this->employee) {
            Log::error('No se encontró el empleado para el usuario autenticado');
            abort(404);
        }
        $this->initializeEditData();
        $this->loadMemoStats();
        $this->loadAgeData();
        $this->loadRoleDistribution();
        $this->loadDepartmentEmployees();
    }

    public function initializeEditData()
    {
        $this->editData = [
            'phone' => $this->employee->phone,
            'address' => $this->employee->address,
            'email' => $this->employee->email,
        ];
    }

    protected function loadMemoStats()
    {
        // Obtener estadísticas de memos del departamento del empleado
        $this->memoStats = [
            'total' => Memo::where('department_id', $this->employee->department_id)->count(),
            'byType' => Memo::where('department_id', $this->employee->department_id)
                ->select('type', DB::raw('count(*) as count'))
                ->groupBy('type')
                ->get()
                ->pluck('count', 'type')
                ->toArray()
        ];
    }

    protected function loadAgeData()
    {
        if ($this->employee->birth_date) {
            $age = Carbon::parse($this->employee->birth_date)->age;
            // Obtener distribución de edades en el departamento
            $departmentAges = Employee::where('department_id', $this->employee->department_id)
                ->whereNotNull('birth_date')
                ->get()
                ->map(function ($emp) {
                    return Carbon::parse($emp->birth_date)->age;
                });

            $this->ageData = [
                'employeeAge' => $age,
                'departmentAverage' => $departmentAges->avg(),
                'youngestAge' => $departmentAges->min(),
                'oldestAge' => $departmentAges->max(),
            ];
        }
    }

    protected function loadRoleDistribution()
    {
        // Obtener distribución de roles en el departamento
        $this->roleDistribution = Employee::where('department_id', $this->employee->department_id)
            ->select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->get()
            ->pluck('count', 'role')
            ->toArray();
    }

    protected function loadDepartmentEmployees()
    {
        // Obtener información sobre empleados en el departamento
        $this->departmentEmployees = [
            'total' => Employee::where('department_id', $this->employee->department_id)->count(),
            'active' => Employee::where('department_id', $this->employee->department_id)
                ->where('is_active', true)
                ->count(),
            'recentJoins' => Employee::where('department_id', $this->employee->department_id)
                ->where('created_at', '>=', now()->subMonths(3))
                ->count()
        ];
    }

    public function openEditModal()
    {
        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->showEditModal = false;
        $this->initializeEditData();
        $this->resetValidation();
    }

    public function updateProfile()
    {
        $this->validate([
            'editData.phone' => 'nullable|string|max:20',
            'editData.address' => 'nullable|string|max:255',
            'editData.email' => 'required|email|max:255',
        ]);

        $this->employee->update([
            'phone' => $this->editData['phone'],
            'address' => $this->editData['address'],
            'email' => $this->editData['email'],
        ]);

        $this->showEditModal = false;
        $this->successMessage = '¡Perfil actualizado correctamente!';
    }

    public function updatedNewImage()
    {
        $this->validate([
            'newImage' => 'image|max:1024', // 1MB Max
        ]);

        $path = $this->newImage->store('employee-photos', 'public');
        
        if ($this->employee->image) {
            Storage::disk('public')->delete($this->employee->image);
        }

        $this->employee->update([
            'image' => $path
        ]);

        $this->newImage = null;
        $this->successMessage = '¡Foto actualizada correctamente!';
    }

    public function clearSuccessMessage()
    {
        $this->successMessage = '';
    }

    public function render()
    {
        Log::info('Renderizando componente con empleado:', [
            'employee_exists' => isset($this->employee),
            'employee_data' => $this->employee
        ]);
        return view('livewire.employee.employee-profile');
    }
}
