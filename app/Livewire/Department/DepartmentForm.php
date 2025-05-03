<?php

namespace App\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DepartmentForm extends Component
{
    public $department;
    public $departmentId;
    public $code;
    public $name;
    public $description;
    public $manager_id;
    public $budget;
    public $phone;
    public $email;
    public $status = true;
    public $isEditing = false;

    protected function rules()
    {
        $uniqueRule = $this->isEditing 
            ? 'unique:departments,code,' . $this->department->id 
            : 'unique:departments,code';

        return [
            'code' => ['required', 'string', 'max:10', $uniqueRule],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10'],
            'manager_id' => ['nullable', 'exists:employees,id'],
            'budget' => ['required', 'numeric', 'min:0'],
            'phone' => ['nullable', 'string', 'max:15'],
            'email' => ['nullable', 'email'],
            'status' => ['boolean'],
        ];
    }

    protected function messages()
    {
        return [
            'code.required' => 'El código es obligatorio.',
            'code.unique' => 'Este código ya está en uso.',
            'code.max' => 'El código no puede tener más de 10 caracteres.',
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'description.min' => 'La descripción debe tener al menos 10 caracteres.',
            'manager_id.exists' => 'El jefe seleccionado no es válido.',
            'budget.required' => 'El presupuesto es obligatorio.',
            'budget.numeric' => 'El presupuesto debe ser un número.',
            'budget.min' => 'El presupuesto no puede ser negativo.',
            'phone.max' => 'El teléfono no puede tener más de 15 caracteres.',
            'email.email' => 'El email debe ser una dirección válida.',
        ];
    }

    public function mount($department = null)
    {
        if ($department) {
            // Si recibimos un ID en lugar de un objeto Department, buscamos el departamento
            if (is_numeric($department)) {
                $this->department = Department::find($department);
            } else {
                $this->department = $department;
            }

            if ($this->department) {
                Log::info('Montando formulario de departamento', [
                    'department_id' => $this->department->id,
                    'status' => (bool)$this->department->status
                ]);
                
                $this->departmentId = $this->department->id;
                $this->code = $this->department->code;
                $this->name = $this->department->name;
                $this->description = $this->department->description;
                $this->manager_id = $this->department->manager_id;
                $this->budget = $this->department->budget;
                $this->phone = $this->department->phone;
                $this->email = $this->department->email;
                // Convertir explícitamente a booleano
                $this->status = (bool)$this->department->status;
                $this->isEditing = true;
            }
        }
    }

    public function updated($propertyName)
    {
        Log::info('Propiedad actualizada', [
            'property' => $propertyName,
            'value' => $this->{$propertyName}
        ]);
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        Log::info('Iniciando guardado de departamento', [
            'isEditing' => $this->isEditing,
            'departmentId' => $this->departmentId,
            'datos_recibidos' => [
                'code' => $this->code,
                'name' => $this->name,
                'description' => $this->description,
                'manager_id' => $this->manager_id,
                'budget' => $this->budget,
                'phone' => $this->phone,
                'email' => $this->email,
                'status' => $this->status
            ]
        ]);

        try {
            DB::beginTransaction();

            $validatedData = $this->validate();

            Log::info('Datos validados', [
                'validated_data' => $validatedData
            ]);

            if ($this->isEditing) {
                $department = Department::findOrFail($this->departmentId);
                
                Log::info('Departamento encontrado para actualizar', [
                    'department_id' => $department->id,
                    'status_antes' => (bool)$department->status
                ]);

                $department->update([
                    'code' => $this->code,
                    'name' => $this->name,
                    'description' => $this->description,
                    'manager_id' => $this->manager_id,
                    'budget' => $this->budget,
                    'phone' => $this->phone,
                    'email' => $this->email,
                    'status' => $this->status
                ]);

                Log::info('Departamento actualizado', [
                    'department_id' => $department->id,
                    'status_despues' => (bool)$department->fresh()->status,
                    'datos_actualizados' => $department->fresh()->toArray()
                ]);

                session()->flash('message', 'Departamento actualizado correctamente.');
            } else {
                $department = Department::create([
                    'code' => $this->code,
                    'name' => $this->name,
                    'description' => $this->description,
                    'manager_id' => $this->manager_id,
                    'budget' => $this->budget,
                    'phone' => $this->phone,
                    'email' => $this->email,
                    'status' => $this->status
                ]);

                Log::info('Nuevo departamento creado', [
                    'department_id' => $department->id,
                    'datos' => $department->toArray()
                ]);

                session()->flash('message', 'Departamento creado correctamente.');
            }

            DB::commit();
            $this->dispatch('departmentUpdated');
            $this->dispatch('closeModal');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar departamento', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            session()->flash('error', 'Error al guardar el departamento: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->dispatch('closeModal');
    }

    public function render()
    {
        $managers = Employee::where('role', 'jefe')->get();
        return view('livewire.department.department-form', compact('managers'));
    }
}
