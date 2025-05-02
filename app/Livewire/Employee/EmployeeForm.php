<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Department;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class EmployeeForm extends Component
{
    use WithFileUploads;

    public $employee;
    public $employeeId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $dni;
    public $phone;
    public $address;
    public $hire_date;
    public $department_id;
    public $role;
    public $birth_date;
    public $is_active = true;
    public $image;
    public $temporaryImage;
    public $isEditing = false;

    protected $queryString = ['email'];

    protected function rules()
    {
        \Log::info('Generando reglas de validación', [
            'isEditing' => $this->isEditing,
            'employeeId' => $this->employeeId
        ]);

        $emailRule = ['required', 'email'];
        $dniRule = ['required', 'regex:/^[0-9]{8}[A-Z]$/'];

        // Si estamos editando, ignorar el email y dni del empleado actual
        if ($this->isEditing) {
            $emailRule[] = Rule::unique('users', 'email')->ignore($this->employee->user_id);
            $dniRule[] = Rule::unique('employees', 'dni')->ignore($this->employee->id);
        } else {
            $emailRule[] = 'unique:users,email';
            $dniRule[] = 'unique:employees,dni';
        }

        $rules = [
            'name' => ['required', 'min:3', 'max:255'],
            'email' => $emailRule,
            'password' => $this->isEditing ? ['nullable', 'min:6'] : ['required', 'min:6'],
            'dni' => $dniRule,
            'phone' => ['nullable', 'regex:/^[0-9]{9}$/'],
            'address' => ['nullable', 'min:5'],
            'hire_date' => ['nullable', 'date'],
            'department_id' => ['nullable', function ($attribute, $value, $fail) {
                if ($value === '-') {
                    return; // Permitir el valor especial '-'
                }
                if ($value !== null) {
                    $exists = \App\Models\Department::where('id', $value)->exists();
                    if (!$exists) {
                        $fail('El departamento seleccionado no es válido.');
                    }
                }
            }],
            'role' => ['nullable', function ($attribute, $value, $fail) {
                if ($value === '-') {
                    return; // Permitir el valor especial '-'
                }
                if ($value !== null) {
                    $validRoles = ['jefe', 'empleado', 'supervisor', 'auxiliar', 'gerente', 'recepcionista', 'cocinero', 'camarero', 'conserje', 'limpiador', 'guardia de seguridad', 'auxiliar administrativo', 'analista'];
                    if (!in_array($value, $validRoles)) {
                        $fail('El cargo seleccionado no es válido.');
                    }
                }
            }],
            'birth_date' => ['nullable', 'date', 'before:today'],
            'is_active' => ['boolean'],
            'image' => ['nullable', 'image']
        ];

        \Log::info('Reglas de validación generadas:', $rules);
        return $rules;
    }

    protected function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria para nuevos empleados.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.regex' => 'El DNI debe tener 8 números seguidos de una letra mayúscula.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.regex' => 'El teléfono debe tener 9 números.',
            'address.required' => 'La dirección es obligatoria.',
            'address.min' => 'La dirección debe tener al menos 5 caracteres.',
            'hire_date.date' => 'La fecha de contratación debe ser una fecha válida.',
            'department_id.required' => 'El departamento es obligatorio.',
            'department_id.exists' => 'El departamento seleccionado no existe.',
            'role.required' => 'El rol es obligatorio.',
            'role.in' => 'El rol seleccionado no es válido.',
            'birth_date.required' => 'La fecha de nacimiento es obligatoria.',
            'birth_date.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'birth_date.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'image.image' => 'El archivo debe ser una imagen.',
        ];
    }

    public function updated($propertyName)
    {
        \Log::info('Validando propiedad:', [
            'property' => $propertyName,
            'value' => $this->$propertyName
        ]);
        
        try {
            $this->validateOnly($propertyName);
            \Log::info('Validación exitosa para: ' . $propertyName);
        } catch (\Exception $e) {
            \Log::error('Error de validación para: ' . $propertyName, [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function mount($employee = null)
    {
        if ($employee) {
            // Si recibimos un ID en lugar de un objeto Employee, buscamos el empleado
            if (is_numeric($employee)) {
                $this->employee = Employee::find($employee);
            } else {
                $this->employee = $employee;
            }

            if ($this->employee) {
                $this->employeeId = $this->employee->id;
                $this->isEditing = true;
                $this->name = $this->employee->name;
                $this->email = $this->employee->email;
                $this->dni = $this->employee->dni;
                $this->phone = $this->employee->phone;
                $this->address = $this->employee->address;
                $this->department_id = $this->employee->department_id;
                $this->role = $this->employee->role;
                // Formatear las fechas al formato Y-m-d que espera el input type="date"
                $this->birth_date = $this->employee->birth_date ? $this->employee->birth_date->format('Y-m-d') : null;
                $this->hire_date = $this->employee->hire_date ? $this->employee->hire_date->format('Y-m-d') : null;
                
                \Log::info('Datos cargados en el formulario:', [
                    'employee_id' => $this->employeeId,
                    'birth_date' => $this->birth_date,
                    'hire_date' => $this->hire_date
                ]);
            }
        }
    }

    public function updatedImage()
    {
        $this->temporaryImage = $this->image;
    }

    public function save()
    {
        \Log::info('Iniciando método save con datos:', [
            'isEditing' => $this->isEditing,
            'employeeId' => $this->employeeId,
            'role' => $this->role,
            'department_id' => $this->department_id,
            'birth_date' => $this->birth_date
        ]);

        // Convertir valores especiales a null
        if ($this->role === '-') {
            $this->role = null;
        }
        if ($this->department_id === '-') {
            $this->department_id = null;
        }

        $validatedData = $this->validate();
        \Log::info('Datos validados:', $validatedData);

        $employeeData = [
            'name' => $this->name,
            'email' => $this->email,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'address' => $this->address,
            'hire_date' => $this->hire_date,
            'department_id' => $this->department_id,
            'role' => $this->role,
            'birth_date' => $this->birth_date,
            'is_active' => $this->is_active
        ];

        \Log::info('Datos a guardar:', $employeeData);

        try {
            DB::beginTransaction();

            if ($this->isEditing) {
                \Log::info('Actualizando empleado existente', ['id' => $this->employee->id]);
                
                // Actualizar usuario
                $this->employee->user->update([
                    'name' => $this->name,
                    'email' => $this->email,
                ]);

                if ($this->password) {
                    $this->employee->user->update([
                        'password' => Hash::make($this->password)
                    ]);
                }

                // Procesar imagen si hay una nueva
                if ($this->image && $this->image instanceof \Illuminate\Http\UploadedFile) {
                    if ($this->employee->image) {
                        Storage::delete('public/' . $this->employee->image);
                    }
                    $employeeData['image'] = $this->image->store('employees', 'public');
                }

                // Actualizar empleado
                $this->employee->update($employeeData);
                \Log::info('Empleado actualizado correctamente', [
                    'id' => $this->employee->id,
                    'role' => $this->employee->role
                ]);

            } else {
                \Log::info('Creando nuevo empleado');
                // Crear nuevo usuario
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'email_verified_at' => now(),
                ]);

                // Procesar imagen si existe
                if ($this->image) {
                    $employeeData['image'] = $this->image->store('employees', 'public');
                }

                // Crear empleado
                $employeeData['user_id'] = $user->id;
                $employee = Employee::create($employeeData);
                \Log::info('Empleado creado correctamente', [
                    'employee_id' => $employee->id,
                    'datos_creados' => $employee->toArray()
                ]);

                session()->flash('message', 'Empleado creado correctamente.');
            }

            DB::commit();
            $this->dispatch('employeeUpdated'); // Emitir evento para actualizar la tabla
            $this->dispatch('closeModal'); // Emitir evento para cerrar el modal
            $this->reset(); // Limpiar el formulario

            session()->flash('message', 
                $this->isEditing ? 'El empleado ha sido actualizado correctamente.' : 'El empleado ha sido creado correctamente.'
            );

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error al guardar empleado:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            session()->flash('error', 'Ha ocurrido un error al guardar el empleado.');
        }
    }

    public function cancel()
    {
        $this->reset();
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.employee.employee-form', [
            'departments' => Department::all()
        ]);
    }
}