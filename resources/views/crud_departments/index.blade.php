@extends('layouts.layout')

@section('content')
<div class="container mt-2">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-0 shadow-sm p-2">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted hover-text-primary transition-all duration-300">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Listado de departamentos</li>
        </ol>
    </nav>

    <div class="card shadow-sm hover-shadow-lg">
        <div class="card-header bg-primary text-white">Listado de departamentos</div>
        <div class="card-body">
            <a href="{{ route('departamentos.crear') }}" class="btn btn-primary mb-3 d-inline-block shadow-md hover-shadow-lg">
                <i class="fas fa-building"></i> Crear Departamento
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
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Jefe de Departamento</th> <!-- Nueva columna -->
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr class="hover-row">
                                <td>{{ $department->code }}</td>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->email ?? 'No disponible' }}</td>
                                <td>{{ $department->manager ? $department->manager->name : 'No asignado' }}</td> <!-- Mostrar el nombre del jefe -->
                                <td>
                                    <span class="badge {{ $department->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $department->status ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('departamentos.editar', $department->id) }}" class="btn btn-warning btn-sm shadow-sm hover-shadow-lg">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('departamentos.eliminar', $department->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm hover-shadow-lg" onclick="return confirm('¿Seguro que deseas eliminar este departamento?');">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('departamentos.show', $department->id) }}" class="btn btn-primary btn-sm shadow-sm hover-shadow-lg">
                                        <i class="bi bi-eye"></i>
                                    </a>
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
