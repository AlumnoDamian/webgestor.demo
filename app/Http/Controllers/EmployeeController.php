<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
   
    // Mostrar lista de empleados
    public function index()
{
    $employees = Employee::all();
    return view('crud_employees.index', compact('employees'));
}

    // Mostrar formulario para crear empleado
    public function create()
    {
        return view('crud_employees.create');
    }

    // Almacenar nuevo empleado
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|unique:employees,dni',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación para la imagen
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('employee_images', 'public'); // Guardar imagen en el almacenamiento público
        }

        Employee::create([
            'user_id' => Auth::id(),
            'dni' => $request->dni,
            'image' => $imagePath,
        ]);

        return redirect()->route('crud_employees.index')->with('success', 'Empleado creado con éxito');
    }

    // Mostrar formulario para editar empleado
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('crud_employees.edit', compact('employee'));
    }

    // Actualizar empleado
    public function update(Request $request, $id)
    {
        $request->validate([
            'dni' => 'required|unique:employees,dni,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación para la imagen
        ]);

        $employee = Employee::findOrFail($id);
        $imagePath = $employee->image;

        if ($request->hasFile('image')) {
            // Si hay una nueva imagen, eliminamos la anterior
            if ($employee->image) {
                Storage::delete('public/' . $employee->image);
            }

            // Guardar nueva imagen
            $imagePath = $request->file('image')->store('employee_images', 'public');
        }

        $employee->update([
            'dni' => $request->dni,
            'image' => $imagePath,
        ]);

        return redirect()->route('crud_employees.index')->with('success', 'Empleado actualizado con éxito');
    }

    // Eliminar empleado
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        // Eliminar imagen si existe
        if ($employee->image) {
            Storage::delete('public/' . $employee->image);
        }

        $employee->delete();

        return redirect()->route('crud_employees.index')->with('success', 'Empleado eliminado con éxito');
    }
}
