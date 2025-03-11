<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;


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

    Route::get('/empleados', [EmployeeController::class, 'index'])->name('empleados.index');
    Route::get('/empleados/crear', [EmployeeController::class, 'create'])->name('empleados.crear');
    Route::post('/empleados', [EmployeeController::class, 'store'])->name('empleados.guardar');
    Route::get('/empleados/{employee}/editar', [EmployeeController::class, 'edit'])->name('empleados.editar');
    Route::put('/empleados/{employee}', [EmployeeController::class, 'update'])->name('empleados.actualizar');
    Route::delete('/empleados/{employee}', [EmployeeController::class, 'destroy'])->name('empleados.eliminar');
    Route::get('/perfil', [EmployeeController::class, 'profile'])->name('profile.index');

    Route::get('/departamento', [DepartmentController::class, 'index'])->name('departamentos.index'); // Listar departamentos
    Route::get('/departamentos/crear', [DepartmentController::class, 'create'])->name('departamentos.crear'); // Formulario de creación
    Route::post('/departamentos', [DepartmentController::class, 'store'])->name('departamentos.guardar'); // Guardar nuevo departamento
    Route::get('/departamentos/{id}/editar', [DepartmentController::class, 'edit'])->name('departamentos.editar'); // Formulario de edición
    Route::put('/departamentos/{id}', [DepartmentController::class, 'update'])->name('departamentos.actualizar'); // Actualizar departamento
    Route::delete('/departamentos/{id}', [DepartmentController::class, 'destroy'])->name('departamentos.eliminar'); // Eliminar departamento
});

require __DIR__.'/auth.php';