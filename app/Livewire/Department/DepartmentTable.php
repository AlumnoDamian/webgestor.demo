<?php

namespace App\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;

class DepartmentTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $showFormModal = false;
    public $showDeleteModal = false;
    public $editingDepartmentId = null;
    public $departmentToDelete = null;

    protected $listeners = [
        'departmentUpdated' => '$refresh',
        'closeModal' => 'closeFormModal'
    ];

    public function mount()
    {
        $this->listeners = [
            'closeModal' => 'closeFormModal',
            'departmentSaved' => '$refresh'
        ];
        $this->perPage = 10;
        $this->sortField = 'name';
        $this->sortDirection = 'asc';
    }

    public function openFormModal($departmentId = null)
    {
        $this->editingDepartmentId = $departmentId;
        $this->showFormModal = true;
        $this->showDeleteModal = false;
    }

    public function closeFormModal()
    {
        $this->showFormModal = false;
        $this->editingDepartmentId = null;
    }

    public function confirmDelete($departmentId)
    {
        logger()->info('Confirmando eliminación del departamento: ' . $departmentId);
        $this->departmentToDelete = Department::find($departmentId);
        logger()->info('Departamento encontrado: ' . ($this->departmentToDelete ? 'Sí' : 'No'));
        $this->showDeleteModal = true;
        $this->showFormModal = false;
    }

    public function closeDeleteModal()
    {
        logger()->info('Cerrando modal de eliminación');
        $this->showDeleteModal = false;
        $this->departmentToDelete = null;
    }

    public function deleteDepartment()
    {
        logger()->info('Iniciando eliminación de departamento');
        if ($this->departmentToDelete) {
            logger()->info('ID del departamento a eliminar: ' . $this->departmentToDelete->id);
            
            try {
                // Actualizar empleados para dejarlos sin departamento
                if ($this->departmentToDelete->employees()->count() > 0) {
                    logger()->info('Desasignando empleados del departamento');
                    $this->departmentToDelete->employees()->update(['department_id' => null]);
                }
                
                // Eliminar el departamento
                $this->departmentToDelete->delete();
                logger()->info('Departamento eliminado correctamente');
                session()->flash('success', 'Departamento eliminado correctamente.');
            } catch (\Exception $e) {
                logger()->error('Error al eliminar departamento: ' . $e->getMessage());
                session()->flash('error', 'Error al eliminar el departamento: ' . $e->getMessage());
            }
            
            $this->closeDeleteModal();
        } else {
            logger()->error('No hay departamento seleccionado para eliminar');
        }
    }

    public function edit($departmentId)
    {
        $this->editingDepartmentId = $departmentId;
        $this->showFormModal = true;
        $this->showDeleteModal = false;
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

    public function getDepartmentsProperty()
    {
        return Department::query()
            ->with(['manager', 'employees']) // Eager loading del manager y empleados
            ->withCount('employees') // Añadir el conteo de empleados
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        $departments = $this->getDepartmentsProperty();

        return view('livewire.department.department-table', [
            'departments' => $departments
        ]);
    }
}
