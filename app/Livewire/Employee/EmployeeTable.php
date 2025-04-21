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
            if ($this->employeeToDelete->image) {
                Storage::disk('public')->delete($this->employeeToDelete->image);
            }
            $this->employeeToDelete->delete();
            $this->closeDeleteModal();
            session()->flash('success', 'Empleado eliminado correctamente.');
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
        $employees = Employee::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $searchTerm = '%' . $this->search . '%';
                    $q->where('name', 'like', $searchTerm)
                        ->orWhere('email', 'like', $searchTerm)
                        ->orWhere('dni', 'like', $searchTerm)
                        ->orWhere('phone', 'like', $searchTerm)
                        ->orWhere('role', 'like', $searchTerm)
                        ->orWhereHas('department', function ($q) use ($searchTerm) {
                            $q->where('name', 'like', $searchTerm);
                        });
                });
            })
            ->when($this->showOnlyActive, function ($query) {
                $query->where('is_active', true);
            })
            ->when($this->sortField, function ($query) {
                $query->orderBy($this->sortField, $this->sortDirection);
            })
            ->paginate($this->perPage);

        return view('livewire.employee.employee-table', [
            'employees' => $employees
        ]);
    }
}
