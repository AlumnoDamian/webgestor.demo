<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    return view('indexDemo');
});

Route::get('/index', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mostrar todos los empleados
    Route::get('/employees', [EmployeeController::class, 'index'])->name('crud_employees.index');
        
    // Mostrar formulario para crear un empleado
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('crud_employees.create');

    // Guardar nuevo empleado
    Route::post('/employees', [EmployeeController::class, 'store'])->name('crud_employees.store');

    // Mostrar formulario para editar un empleado
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('crud_employees.edit');

    // Actualizar empleado
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('crud_employees.update');

    // Eliminar empleado
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('crud_employees.destroy');

});

require __DIR__.'/auth.php';