<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

#[Locked]
class EmployeeTable extends Component
{
    use WithPagination;

    #[Locked]
    public $search = '';
    #[Locked]
    public $showOnlyActive = false;
    #[Locked]
    public $perPage = 10;
    #[Locked]
    public $sortField = 'name';
    #[Locked]
    public $sortDirection = 'asc';
    #[Locked]
    public $showFormModal = false;
    #[Locked]
    public $showDeleteModal = false;
    #[Locked]
    public $editingEmployeeId = null;
    #[Locked]
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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingShowOnlyActive()
    {
        $this->resetPage();
    }

    public function openFormModal($employeeId = null)
    {
        \Log::info('Abriendo modal de formulario:', [
            'employee_id' => $employeeId,
            'previous_state' => [
                'showFormModal' => $this->showFormModal,
                'editingEmployeeId' => $this->editingEmployeeId,
                'showDeleteModal' => $this->showDeleteModal
            ]
        ]);

        $this->editingEmployeeId = $employeeId;
        $this->showFormModal = true;
        $this->showDeleteModal = false;

        \Log::info('Estado actualizado del modal:', [
            'showFormModal' => $this->showFormModal,
            'editingEmployeeId' => $this->editingEmployeeId,
            'showDeleteModal' => $this->showDeleteModal
        ]);
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
                \Log::error('Error al eliminar empleado: ' . $e->getMessage());
            }
        }
        
        $this->closeDeleteModal();
    }

    public function edit($employeeId)
    {
        \Log::info('Método edit llamado con ID:', ['employee_id' => $employeeId]);
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

    public function render()
    {
        $employees = Employee::query()
            ->with('department') // Solo eager loading de department
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%')
                        ->orWhere('dni', 'like', '%' . $this->search . '%')
                        ->orWhereHas('department', function ($q) {
                            $q->where('name', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->showOnlyActive, function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        // Estadísticas para el dashboard
        $totalActive = Employee::where('is_active', true)->count();
        $totalInactive = Employee::where('is_active', false)->count();
        $rolesDistribution = Employee::select('role', \DB::raw('count(*) as total'))
            ->groupBy('role')
            ->get();
        $lastUpdated = Employee::latest('updated_at')->first()?->updated_at;

        return view('livewire.employee.employee-table', [
            'employees' => $employees,
            'totalActive' => $totalActive,
            'totalInactive' => $totalInactive,
            'rolesDistribution' => $rolesDistribution,
            'lastUpdated' => $lastUpdated
        ]);
    }
}
