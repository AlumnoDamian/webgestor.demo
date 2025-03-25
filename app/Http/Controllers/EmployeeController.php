<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Storage;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function profile()
    {
        $employee = $this->employeeService->getProfile(auth()->id());
        return view('profile_employee.index', compact('employee'));
    }

    public function index()
    {
        $employees = $this->employeeService->getEmployeeRepository()->getAll();
        return view('crud_employees.index', compact('employees'));
    }

    public function create()
    {
        $roles = config('roles.employee_roles');
        $departments = Department::all();
        return view('crud_employees.create', compact('departments', 'roles'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate($this->validationRules());

        // Llamada al servicio para almacenar al empleado
        $employee = $this->employeeService->storeEmployee($validatedData);

        return redirect()->route('empleados.index')->with('success', 'Empleado creado con éxito');
    }

    public function edit(Employee $employee)
    {
        $roles = config('roles.employee_roles');
        $departments = Department::all();
        return view('crud_employees.edit', compact('employee', 'departments', 'roles'));
    }

    public function update(Request $request, Employee $employee)
    {
        $user = $employee->user; // Verifica si el usuario existe
        if (!$user) {
            return redirect()->route('empleados.index')->with('error', 'Usuario no encontrado para este empleado.');
        }
    
        $validatedData = $request->validate($this->validationRules($employee->id));
    
        if ($request->hasFile('image')) {
            $this->deleteOldImage($employee->image);
            $validatedData['image'] = $this->handleImageUpload($request);
        }
    
        // Verifica si la contraseña fue proporcionada
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            // If no password is provided, remove the password key from the array
            unset($validatedData['password']);
        }
    
        // Actualiza el empleado y sus departamentos
        $employee->update($validatedData);
        $employee->departments()->sync([$request->department_id]);
    
        // Actualiza el email solo si fue proporcionado
        if ($request->filled('email')) {
            $user->update(['email' => $request->email]);
        }
    
        // Actualiza la contraseña del usuario solo si fue proporcionada
        if ($request->filled('password')) {
            $user->update(['password' => $validatedData['password']]);
        }
    
        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito');
    }
    
    

    public function destroy(Employee $employee)
    {
        $this->deleteOldImage($employee->image);
        $this->employeeService->deleteEmployee($employee);
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado con éxito');
    }

    private function validationRules($employeeId = null)
    {
        return [
            'dni' => ['required', 'unique:employees,dni,' . $employeeId],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $employeeId],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'birth_date' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:9'],
            'is_active' => ['required', 'boolean'],
            'department_id' => ['required', 'exists:departments,id'],
            'role' => ['required', 'string'],
        ];
    }

    private function handleImageUpload($request)
    {
        return $request->hasFile('image') 
            ? $request->file('image')->store('employee_images', 'public') 
            : null;
    }

    private function deleteOldImage($image)
    {
        if ($image) {
            Storage::delete('public/' . $image);
        }
    }
}
