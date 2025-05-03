<?php

use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', App\Livewire\Dashboard::class)
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    // Profile routes
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
    
    // Employee Profile route
    Route::get('/perfil', App\Livewire\Employee\EmployeeProfile::class)->name('perfil');

    // Employee routes
    Route::get('/empleados', App\Livewire\Employee\EmployeeTable::class)->name('empleados.index');
    Route::get('/empleados/crear', App\Livewire\Employee\EmployeeForm::class)->name('empleados.crear');
    Route::get('/empleados/{employee}/editar', App\Livewire\Employee\EmployeeForm::class)->name('empleados.editar');

    // Department routes
    Route::get('/departamentos', App\Livewire\Department\DepartmentTable::class)->name('departamentos.index');
    Route::get('/departamentos/crear', App\Livewire\Department\DepartmentForm::class)->name('departamentos.crear');
    Route::get('/departamentos/{department}/editar', App\Livewire\Department\DepartmentForm::class)->name('departamentos.editar');

    // Schedule routes
    Route::controller(ScheduleController::class)->prefix('cuadrante')->group(function () {
        Route::get('/', 'show')->name('cuadrante.show');
        Route::post('/guardar', 'store')->name('cuadrante.store');
        Route::get('/editar', 'edit')->name('cuadrante.edit');
        Route::put('/actualizar', 'update')->name('cuadrante.update');
        Route::get('/ver', 'view')->name('cuadrante.view');
    });

    // Documentation routes
    Route::controller(DocumentationController::class)->group(function () {
        Route::get('/documentos', 'index')->name('documentos.index');
        Route::get('/documentos/crear', 'create')->name('documentos.crear');
        Route::post('/documentos', 'store')->name('documentos.guardar');
        Route::get('/documentos/{id}/editar', 'edit')->name('documentos.editar');
    });

    // Memo routes
    Route::controller(MemoController::class)->group(function () {
        Route::get('/memos', 'index')->name('memos.index');
        Route::get('/memos/crear', 'create')->name('memos.crear');
        Route::post('/memos', 'store')->name('memos.store');
        Route::put('/memos/{id}', 'update')->name('memos.update');
    });

});

Route::middleware('guest')->group(function () {
    Route::get('login', App\Livewire\Auth\LoginForm::class)->name('login');
    Route::get('register', App\Livewire\Auth\RegisterForm::class)->name('register');
});

require __DIR__ . '/auth.php';