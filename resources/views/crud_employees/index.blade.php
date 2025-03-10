@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Listado de departamentos</h1>
    
    <div class="card">
        <div class="card-header">
            CRUD
        </div>
        <div class="card-body">
            <a href="{{ route('crud_employees.create') }}" class="btn btn-primary mb-3">Crear Empleado</a>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>{{ $employee->dni }}</td>
                                <td>
                                    @if ($employee->image)
                                        <img src="{{ Storage::url($employee->image) }}" alt="Imagen del empleado" width="50" class="img-thumbnail">
                                    @else
                                        <span class="badge bg-secondary">No disponible</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('crud_employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        <form action="{{ route('crud_employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este registro?')">Eliminar</button>
                                        </form>
                                    </div>
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

