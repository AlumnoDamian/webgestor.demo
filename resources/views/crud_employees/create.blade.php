@extends('layouts.layout')

@section('content')
<div class="container-fluid container-custom">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-0 shadow-sm p-2">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted hover-text-primary transition-all duration-300">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('empleados.index') }}" class="text-muted hover-text-primary transition-all duration-300">Listado de empleados</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear un empleado</li>
        </ol>
    </nav>

    <div class="card shadow-lg rounded-lg">
        <div class="card-header bg-primary text-white">Crear un empleado</div>
        @include('crud_employees.employees_form', ['route' => route('empleados.guardar'), 'buttonText' => 'Guardar'])
    </div>
</div>
@endsection
