@extends('layouts.layout')

@section('content')
<div class="container-fluid container-custom">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-0 shadow-sm p-2">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted hover-text-primary transition-all duration-300">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('crud_departamentos.index') }}" class="text-muted hover-text-primary transition-all duration-300">Departamentos</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $department->name }}</li>
        </ol>
    </nav>

    <div class="card shadow-sm hover-shadow-lg">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-building"></i> {{ $department->name }}
        </div>
        <div class="card-body">
            <p><strong>Código:</strong> {{ $department->code }}</p>
            <p><strong>Descripción:</strong> {{ $department->description }}</p>
            <p><strong>Presupuesto:</strong> ${{ number_format($department->budget, 2) }}</p>
            <p><strong>Teléfono:</strong> {{ $department->phone }}</p>
            <p><strong>Email:</strong> {{ $department->email }}</p>
            <p><strong>Estado:</strong> 
                <span class="badge {{ $department->status ? 'bg-success' : 'bg-danger' }}">
                    {{ $department->status ? 'Activo' : 'Inactivo' }}
                </span>
            </p>
        </div>
    </div>

    <div class="row mt-3">
        <!-- Jefe del departamento -->
        <div class="col-md-6">
            <div class="card shadow-sm hover-shadow-lg">
                <div class="card-header bg-secondary text-white">
                    <i class="bi bi-person-badge"></i> Jefe del Departamento
                </div>
                <div class="card-body">
                    @if ($department->manager)
                        <p><strong>Nombre:</strong> {{ $department->manager->name }}</p>
                        <p><strong>Email:</strong> {{ $department->manager->email }}</p>
                    @else
                        <p>No asignado</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Empleados -->
        <div class="col-md-6">
            <div class="card shadow-sm hover-shadow-lg">
                <div class="card-header bg-info text-white">
                    <i class="bi bi-people"></i> Empleados
                </div>
                <div class="card-body">
                    @if ($department->employees->count())
                        <ul class="list-group list-group-flush">
                            @foreach ($department->employees as $employee)
                                <li class="list-group-item">
                                    <i class="bi bi-person-circle"></i> {{ $employee->name }} - {{ $employee->position }}
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No hay empleados en este departamento.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('crud_departamentos.index') }}" class="btn btn-primary shadow-sm hover-shadow-lg">
            <i class="bi bi-arrow-left"></i> Volver al listado
        </a>
    </div>
</div>
@endsection
