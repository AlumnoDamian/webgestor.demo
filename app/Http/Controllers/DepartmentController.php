<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Mostrar la lista de departamentos.
     */
    public function index()
    {
        $departments = Department::all();
        return view('crud_departments.index', compact('departments'));
    }

    /**
     * Mostrar el formulario de creación.
     */
    public function create()
    {
        $managers = Employee::all(); // Obtener todos los empleados para asignar como jefes
        return view('crud_departments.create', compact('managers'));
    }

    /**
     * Guardar un nuevo departamento.
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'code' => 'required|string|unique:departments,code|max:10',
            'name' => 'required|string|unique:departments,name|max:255',
            'description' => 'nullable|string',
            'manager_id' => 'nullable|exists:employees,id',
            'budget' => 'required|numeric|min:0',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:departments,email',
            'status' => 'required|boolean',
        ]);

        // Crear el departamento
        Department::create($validatedData);

        return redirect()->route('departamentos.index')->with('success', 'Departamento creado con éxito.');
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        $managers = Employee::all(); // Lista de empleados para seleccionar un jefe de departamento
        return view('crud_departments.edit', compact('department', 'managers'));
    }

    /**
     * Actualizar un departamento existente.
     */
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        // Validación de datos
        $validatedData = $request->validate([
            'code' => 'required|string|unique:departments,code,' . $id . '|max:10',
            'name' => 'required|string|unique:departments,name,' . $id . '|max:255',
            'description' => 'nullable|string',
            'manager_id' => 'nullable|exists:employees,id',
            'budget' => 'required|numeric|min:0',
            'phone' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:departments,email,' . $id,
            'status' => 'required|boolean',
        ]);

        // Actualizar el departamento
        $department->update($validatedData);

        return redirect()->route('departamentos.index')->with('success', 'Departamento actualizado con éxito.');
    }

    /**
     * Eliminar un departamento.
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return redirect()->route('departamentos.index')->with('success', 'Departamento eliminado con éxito.');
    }
}
