<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;


class EmployeeTable extends Component
{
    use WithPagination;

    
    public $showOnlyActive = false;
    
    public $perPage = 10;
    
    public $sortField = 'name';
    
    public $sortDirection = 'asc';
    
    public $showFormModal = false;
    
    public $showDeleteModal = false;
    
    public $editingEmployeeId = null;
    
    public $employeeToDelete = null;

    protected $listeners = [
        'employeeUpdated' => '$refresh',
        'closeModal' => 'closeFormModal'
    ];

    public function mount()
    {
        $this->perPage = 10;
        $this->sortField = 'name';
        $this->sortDirection = 'asc';
    }

    public function updatingShowOnlyActive()
    {
        $this->resetPage();
    }

    public function openFormModal($employeeId = null)
    {
        $this->editingEmployeeId = $employeeId;
        $this->showFormModal = true;
        $this->showDeleteModal = false;
    }

    public function closeFormModal()
    {
        $this->showFormModal = false;
        $this->editingEmployeeId = null;
    }

    public function confirmDelete($employeeId)
    {
        $this->employeeToDelete = Employee::find($employeeId);
        $this->showDeleteModal = true;
        $this->showFormModal = false;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->employeeToDelete = null;
    }

    public function deleteEmployee()
    {
        if ($this->employeeToDelete) {
            try {
                // Eliminar el usuario asociado si existe
                if ($this->employeeToDelete->user) {
                    $this->employeeToDelete->user->delete();
                }
                
                // Eliminar el empleado
                $this->employeeToDelete->delete();
                
                session()->flash('success', 'Empleado eliminado correctamente.');
            } catch (\Exception $e) {
                session()->flash('error', 'Error al eliminar el empleado.');
            }
        }
        
        $this->closeDeleteModal();
    }

    public function edit($employeeId)
    {
        $this->openFormModal($employeeId);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function getMostCommonRoleProperty()
    {
        return Employee::query()
            ->selectRaw('role, COUNT(*) as count')
            ->whereNotNull('role')
            ->groupBy('role')
            ->orderByDesc('count')
            ->first();
    }

    public function getEmployeesProperty()
    {
        return Employee::query()
            ->with(['user.roles'])  // Eager loading de la relación user y roles
            ->when($this->showOnlyActive, function ($query) {
                $query->where('status', true);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        $employees = $this->getEmployeesProperty();
        $mostCommonRole = $this->getMostCommonRoleProperty();

        // Estadísticas para el dashboard
        $totalActive = Employee::where('is_active', true)->count();
        $totalInactive = Employee::where('is_active', false)->count();
        $rolesDistribution = Employee::selectRaw('role, COUNT(*) as count')->groupBy('role')->get();
        $lastUpdated = Employee::latest('updated_at')->first()?->updated_at;

        return view('livewire.employee.employee-table', [
            'employees' => $employees,
            'totalActive' => $totalActive,
            'totalInactive' => $totalInactive,
            'rolesDistribution' => $rolesDistribution,
            'lastUpdated' => $lastUpdated,
            'mostCommonRole' => $mostCommonRole
        ]);
    }
}
