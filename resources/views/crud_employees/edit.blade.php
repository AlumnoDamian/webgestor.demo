@extends('layouts.layout')

@section('content')
<div class="container mt-2">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-0 shadow-sm p-2">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted hover-text-primary transition-all duration-300">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}" class="text-muted hover-text-primary transition-all duration-300">Listado de empleados</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar el empleado</li>
        </ol>
    </nav>

    <div class="card shadow-lg rounded-lg">
        <div class="card-header bg-primary text-white">Editar el empleado</div>
        @include('crud_employees.employees_form', ['route' => route('empleados.actualizar', $employee->id), 'method' => 'PUT', 'employee' => $employee, 'buttonText' => 'Actualizar'])
    </div>
</div>
@endsection
