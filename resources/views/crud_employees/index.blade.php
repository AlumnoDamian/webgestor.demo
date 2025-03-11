@extends('layouts.layout')

@section('content')
<div class="container mt-2">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-0 shadow-sm p-2">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted hover-text-primary transition-all duration-300">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de empleados</li>
        </ol>
    </nav>

    <div class="card shadow-sm hover-shadow-lg">
        <div class="card-header bg-primary text-white">Listado de empleados</div>
        <div class="card-body">
            <a href="{{ route('empleados.crear') }}" class="btn btn-primary mb-3 d-inline-block shadow-md hover-shadow-lg">
                <i class="fas fa-user-plus"></i> Crear Empleado
            </a>
            
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr class="hover-row">
                                <td>{{ $employee->dni }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>
                                    @if ($employee->image)
                                        <img src="{{ Storage::url($employee->image) }}" alt="Imagen" width="50" class="img-thumbnail">
                                    @else
                                        <span class="badge bg-secondary">No disponible</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $employee->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $employee->is_active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('empleados.editar', $employee->id) }}" class="btn btn-warning btn-sm shadow-sm hover-shadow-lg">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('empleados.eliminar', $employee->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm hover-shadow-lg" onclick="return confirm('¿Seguro que deseas eliminar este empleado?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
