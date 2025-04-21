<?php

namespace App\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;

class DepartmentTable extends Component
{
    use WithPagination;

    public $search = '';
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
        $this->perPage = 10;
        $this->sortField = 'name';
        $this->sortDirection = 'asc';
    }

    public function updatingSearch()
    {
        $this->resetPage();
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
        $this->departmentToDelete = Department::find($departmentId);
        $this->showDeleteModal = true;
        $this->showFormModal = false;
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->departmentToDelete = null;
    }

    public function deleteDepartment()
    {
        if ($this->departmentToDelete) {
            // Verificar si el departamento tiene empleados
            if ($this->departmentToDelete->employees()->count() > 0) {
                session()->flash('error', 'No se puede eliminar el departamento porque tiene empleados asignados.');
                $this->closeDeleteModal();
                return;
            }
            
            $this->departmentToDelete->delete();
            $this->closeDeleteModal();
            session()->flash('success', 'Departamento eliminado correctamente.');
        }
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
        $departments = Department::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $searchTerm = '%' . $this->search . '%';
                    $q->where('name', 'like', $searchTerm)
                        ->orWhere('description', 'like', $searchTerm);
                });
            })
            ->when($this->sortField, function ($query) {
                $query->orderBy($this->sortField, $this->sortDirection);
            })
            ->paginate($this->perPage);

        return view('livewire.department.department-table', [
            'departments' => $departments
        ]);
    }
}
