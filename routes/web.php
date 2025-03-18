<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DocumentacionController;


Route::get('/', function () {
    return view('indexDemo');
});



Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

    Route::get('/departamento', [DepartmentController::class, 'index'])->name('crud_crud_departamentos.index'); // Listar departamentos
    Route::get('/departamentos/crear', [DepartmentController::class, 'create'])->name('departamentos.crear'); // Formulario de creación
    Route::post('/departamentos', [DepartmentController::class, 'store'])->name('departamentos.guardar'); // Guardar nuevo departamento
    Route::get('/departamentos/{id}/editar', [DepartmentController::class, 'edit'])->name('departamentos.editar'); // Formulario de edición
    Route::put('/departamentos/{id}', [DepartmentController::class, 'update'])->name('departamentos.actualizar'); // Actualizar departamento
    Route::delete('/departamentos/{id}', [DepartmentController::class, 'destroy'])->name('departamentos.eliminar'); // Eliminar departamento
    Route::get('/departamentos', [DepartmentController::class, 'index'])->name('crud_departamentos.index');
    Route::get('/departamentos/{id}', [DepartmentController::class, 'show'])->name('departamentos.show');

    Route::get('cuadrante', [ScheduleController::class, 'show'])->name('cuadrante.show');
    Route::post('cuadrante', [ScheduleController::class, 'store'])->name('cuadrante.store');

    Route::get('/comunicados', [MemoController::class, 'index'])->name('comunicados.index');
    Route::get('/comunicados/create', [MemoController::class, 'create'])->name('comunicados.crear');
    Route::post('/comunicados', [MemoController::class, 'store'])->name('comunicados.guardar');

    Route::get('/anuncios', [AnnouncementController::class, 'index'])->name('anuncios.index');
    Route::get('/anuncios/crear', [AnnouncementController::class, 'create'])->name('anuncios.crear');
    Route::post('/anuncios', [AnnouncementController::class, 'store'])->name('anuncios.guardar');

    Route::get('/documentacion', [DocumentacionController::class, 'index'])->name('documentacion.index');
});

require __DIR__.'/auth.php';