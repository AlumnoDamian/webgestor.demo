@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Editar Empleado</h1>

    <div class="card">
        <div class="card-header">
            Formulario de Edición
        </div>
        <div class="card-body">
            <form action="{{ route('crud_employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" name="dni" id="dni" class="form-control @error('dni') is-invalid @enderror" value="{{ old('dni', $employee->dni) }}" required>
                    @error('dni')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="form-label">Imagen</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    @if ($employee->image)
                        <div class="mt-2">
                            <p class="text-muted">Imagen actual:</p>
                            <img src="{{ Storage::url($employee->image) }}" alt="Imagen del empleado" width="100" class="img-thumbnail">
                        </div>
                    @endif
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('crud_employees.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

