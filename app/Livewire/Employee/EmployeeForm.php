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

        return [
            'name' => ['required', 'min:3', 'max:255'],
            'email' => $emailRule,
            'password' => $this->isEditing ? ['nullable', 'min:6'] : ['required', 'min:6'],
            'dni' => $dniRule,
            'phone' => ['required', 'regex:/^[0-9]{9}$/'],
            'address' => ['required', 'min:5'],
            'department_id' => ['required', 'exists:departments,id'],
            'role' => ['required', 'in:jefe,empleado,supervisor,auxiliar,gerente,recepcionista,cocinero,camarero,conserje,limpiador,guardia de seguridad,auxiliar administrativo,analista'],
            'birth_date' => ['required', 'date', 'before:today'],
            'is_active' => ['boolean'],
            'image' => ['nullable', 'image']
        ];
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

    public function mount($employee = null)
    {
        if ($employee) {
            $this->employee = Employee::find($employee);
            if ($this->employee) {
                $this->isEditing = true;
                $this->name = $this->employee->name;
                $this->email = $this->employee->email;
                $this->dni = $this->employee->dni;
                $this->phone = $this->employee->phone;
                $this->address = $this->employee->address;
                $this->department_id = $this->employee->department_id;
                $this->role = $this->employee->role;
                $this->birth_date = $this->employee->birth_date;
                $this->is_active = $this->employee->is_active;
                $this->image = $this->employee->image;
            }
        } else {
            // Valores por defecto para nuevo empleado
            $this->is_active = true; // Por defecto activo
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedImage()
    {
        $this->temporaryImage = $this->image;
    }

    public function save()
    {
        \Log::info('Iniciando método save');
        \Log::info('Datos recibidos:', [
            'name' => $this->name,
            'email' => $this->email,
            'dni' => $this->dni,
            'phone' => $this->phone,
            'department_id' => $this->department_id,
            'isEditing' => $this->isEditing,
            'is_active' => $this->is_active
        ]);

        try {
            \Log::info('Iniciando validación');
            $validatedData = $this->validate();
            \Log::info('Datos validados correctamente');

            $employeeData = [
                'name' => $this->name,
                'email' => $this->email,
                'dni' => $this->dni,
                'phone' => $this->phone,
                'address' => $this->address,
                'department_id' => $this->department_id,
                'role' => $this->role,
                'birth_date' => $this->birth_date,
                'is_active' => $this->is_active
            ];

            if ($this->isEditing) {
                \Log::info('Actualizando empleado existente');
                // Actualizar usuario
                $user = $this->employee->user;
                $user->name = $this->name;
                $user->email = $this->email;
                if ($this->password) {
                    $user->password = Hash::make($this->password);
                }
                $user->save();

                // Procesar imagen si hay una nueva
                if ($this->image && $this->image instanceof \Illuminate\Http\UploadedFile) {
                    if ($this->employee->image) {
                        Storage::delete('public/' . $this->employee->image);
                    }
                    $employeeData['image'] = $this->image->store('employees', 'public');
                }

                // Actualizar empleado
                $this->employee->update($employeeData);
                session()->flash('message', 'Empleado actualizado correctamente.');
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
                Employee::create($employeeData);
                session()->flash('message', 'Empleado creado correctamente.');
            }

            \Log::info('Operación completada exitosamente');
            $this->dispatch('employeeUpdated'); // Emitir evento para actualizar la tabla
            $this->dispatch('closeModal'); // Emitir evento para cerrar el modal
            $this->reset(); // Limpiar el formulario
        } catch (\Exception $e) {
            \Log::error('Error en save():', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            session()->flash('error', 'Ha ocurrido un error al guardar el empleado: ' . $e->getMessage());
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