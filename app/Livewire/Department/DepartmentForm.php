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
            'description' => ['nullable', 'string'],
            'manager_id' => ['nullable', 'exists:employees,id'],
            'budget' => ['nullable', 'numeric', 'min:0'],
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
            'budget.min' => 'El presupuesto no puede ser negativo.',
            'phone.max' => 'El teléfono no puede tener más de 15 caracteres.',
            'email.email' => 'El formato del email no es válido.',
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
        if (in_array($propertyName, ['code', 'name'])) {
            $this->validateOnly($propertyName, [
                'code' => ['required', 'string', 'max:10', $this->isEditing ? 'unique:departments,code,' . $this->department->id : 'unique:departments,code'],
                'name' => ['required', 'string', 'min:3', 'max:255'],
            ]);
        }
    }

    public function save()
    {
        // Validar los campos requeridos primero
        $rules = [
            'code' => ['required', 'string', 'max:10', $this->isEditing ? 'unique:departments,code,' . $this->departmentId : 'unique:departments,code'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string'],
            'manager_id' => ['nullable', 'exists:employees,id'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'phone' => ['nullable', 'string', 'max:15'],
            'email' => ['nullable', 'email'],
            'status' => ['boolean'],
        ];

        $messages = [
            'code.required' => 'El código del departamento es obligatorio.',
            'code.unique' => 'Este código ya está en uso.',
            'code.max' => 'El código no puede tener más de 10 caracteres.',
            'name.required' => 'El nombre del departamento es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'budget.min' => 'El presupuesto no puede ser negativo.',
            'phone.max' => 'El teléfono no puede tener más de 15 caracteres.',
            'email.email' => 'El formato del email no es válido.',
        ];

        try {
            // Validar con mensajes personalizados
            $validatedData = $this->validate($rules, $messages);

            DB::beginTransaction();

            // Convertir campos vacíos a null
            $departmentData = [
                'code' => $this->code,
                'name' => $this->name,
                'description' => $this->description ?: null,
                'manager_id' => $this->manager_id ?: null,
                'budget' => $this->budget ?: null,
                'phone' => $this->phone ?: null,
                'email' => $this->email ?: null,
                'status' => $this->status
            ];

            if ($this->isEditing) {
                $department = Department::findOrFail($this->departmentId);
                $department->update($departmentData);
                session()->flash('message', 'Departamento actualizado correctamente.');
            } else {
                Department::create($departmentData);
                session()->flash('message', 'Departamento creado correctamente.');
            }

            DB::commit();
            $this->dispatch('departmentUpdated');
            $this->dispatch('closeModal');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Capturar errores de validación y mostrarlos
            $this->setErrorBag($e->validator->getMessageBag());
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar departamento: ' . $e->getMessage());
            session()->flash('error', 'Error al guardar el departamento. Por favor, verifica los datos e intenta nuevamente.');
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
