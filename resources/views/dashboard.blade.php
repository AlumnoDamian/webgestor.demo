@extends('layouts.layout')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Dashboard</h1>

        <div class="row">
            <!-- Card de Perfil del Usuario -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Perfil del Usuario</h5>
                    </div>
                    <div class="card-body">
                        <!-- Imagen del empleado -->
                        <div class="d-flex align-items-center">
                            <img src="{{ $employee->image ? asset('storage/' . $employee->image) : 'https://via.placeholder.com/100' }}" 
                                 class="rounded-circle me-3" alt="Foto de Perfil" width="100" height="100">
                            <div>
                                <h5>{{ $employee->name }}</h5>
                                <p>{{ $employee->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card de Departamentos -->
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Departamentos</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($departments as $department)
                                <li class="list-group-item">
                                    <strong>{{ $department->name }}</strong>
                                    <p>{{ $department->description }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
