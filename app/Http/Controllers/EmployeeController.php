<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EmployeeController extends Controller
{
    public function profile()
    {
        $employee = Employee::where('user_id', auth()->id())->firstOrFail();
        return view('profile_employee.index', compact('employee'));
    }
    
    

    public function index()
    {
        $employees = Employee::with('departments')->get();
        return view('crud_employees.index', compact('employees'));
    }

    public function create()
    {
        $roles = ['jefe', 'empleado', 'supervisor', 'auxiliar', 'gerente', 'recepcionista', 'cocinero', 'camarero', 'conserje', 'limpiador', 'guardia de seguridad', 'auxiliar administrativo', 'analista']; // Roles definidos
        $departments = Department::all();  // Obtener todos los departamentos
        return view('crud_employees.create', compact('departments', 'roles'));    
    }

    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'dni' => 'required|unique:employees,dni', // DNI único en la tabla de empleados
            'name' => 'required|string|max:255', // Nombre obligatorio y de longitud máxima
            'email' => 'required|email|unique:users,email', // Email opcional, pero debe ser único en la tabla users
            'password' => 'required|string|min:8|confirmed', // Confirmación de contraseña
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Imagen opcional con tipo y tamaño específico
            'birth_date' => 'required|date', // Fecha de nacimiento opcional
            'address' => 'required|string', // Dirección opcional
            'phone' => 'required|string|max:9', // Teléfono opcional
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|string'  // Asegúrate de que el rol es requerido
        ]);

        // Si no se proporciona un email, generamos uno automáticamente
        $email = $request->email ?? strtolower(str_replace(' ', '', $request->name)) . '@gmail.com';

        // Asegurarnos de que el email es único
        while (User::where('email', $email)->exists()) {
            // Si el email ya existe, generamos uno nuevo
            $email = strtolower(str_replace(' ', '', $request->name)) . rand(100, 999) . '@gmail.com';
        }

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => Hash::make($request->password),
        ]);

        // Subir la imagen si existe
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('employee_images', 'public');
        }

        // Crear el empleado
        $employee = Employee::create([
            'user_id' => $user->id,
            'dni' => $request->dni,
            'name' => $request->name,
            'email' => $email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $imagePath,
            'role' => $request->role
        ]);

        // Guardar el departamento en la tabla intermedia
        $employee->departments()->attach($request->department_id);

        return redirect()->route('empleados.index')->with('success', 'Empleado creado con éxito');
    }


    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();  // Obtener todos los departamentos
        $roles = ['jefe', 'empleado', 'supervisor', 'auxiliar', 'gerente', 'recepcionista', 'cocinero', 'camarero', 'conserje', 'limpiador', 'guardia de seguridad', 'auxiliar administrativo', 'analista']; // Roles definidos
        return view('crud_employees.edit', compact('employee', 'departments', 'roles'));
    }


    public function update(Request $request, $id)
    {
        // Obtener el empleado y su usuario asociado
        $employee = Employee::findOrFail($id);
        $user = User::findOrFail($employee->user_id);

        // Validación de datos
        $request->validate([
            'dni' => 'required|unique:employees,dni,' . $id, // El DNI es único, pero se permite el mismo para el empleado actual
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // El email solo es único si se cambia
            'password' => 'nullable|string|min:8|confirmed', // Contraseña opcional
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Imagen opcional
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'is_active' => 'required|boolean',
            'department_id' => 'required|exists:departments,id',
            'role' => 'required|string'  // Asegúrate de que el rol es requerido
        ]);

        $imagePath = $employee->image;

        // Si se sube una nueva imagen
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($employee->image) {
                Storage::delete('public/' . $employee->image);
            }
            // Guardar la nueva imagen
            $imagePath = $request->file('image')->store('employee_images', 'public');
        }

        // Actualizar los datos del empleado
        $employee->update([
            'dni' => $request->dni,
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $imagePath,
            'is_active' => $request->is_active,
            'role' => $request->role
        ]);

        // Actualizar el departamento en la tabla intermedia
        $employee->departments()->sync([$request->department_id]);

        // Si se ha proporcionado una nueva contraseña, la actualizamos también
        if ($request->filled('password')) {
            $user->update([
                'email' => $request->email ?? $user->email, // El email solo se actualiza si se proporciona uno nuevo
                'password' => Hash::make($request->password), // Actualización de la contraseña
            ]);
        } else {
            $user->update([
                'email' => $request->email ?? $user->email, // Si no se proporciona un nuevo email, mantenemos el actual
            ]);
        }

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito');
    }



    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee->image) {
            Storage::delete('public/' . $employee->image);
        }

        $employee->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado con éxito');
    }
}