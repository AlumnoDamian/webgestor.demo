@extends('layouts.layout')

@section('content')
    <div class="container-fluid container-custom">
        <h1 class="text-center mb-4">Dashboard</h1>

        <!-- Fila Principal -->
        <div class="row justify-content-center align-items-stretch">

            <!-- Perfil del Usuario -->
            <div class="col-md-4 d-flex">
                <div class="card flex-fill">
                    <div class="card-header text-center">
                        <h5>Perfil</h5>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ $employee->image ? asset('storage/' . $employee->image) : 'https://via.placeholder.com/100' }}" 
                             class="rounded-circle mb-3" alt="Foto de Perfil" width="100" height="100">
                        <h5>{{ $employee->name }}</h5>
                        <p>{{ $employee->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Departamentos y Últimos Anuncios -->
            <div class="col-md-8 d-flex">
                <div class="row w-100 gx-3">
                    
                    <!-- Departamentos -->
                    <div class="col-md-6 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header text-center">
                                <h5>Departamentos</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($departments as $department)
                                        <li class="list-group-item text-center mb-2 border">
                                            <strong>{{ $department->name }}</strong>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Últimos Anuncios -->
                    <div class="col-md-6 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header text-center">
                                <h5>Últimos Anuncios</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($announcements as $announcement)
                                        <li class="list-group-item text-center bg-primary text-white mb-2 border">
                                            <strong>{{ $announcement->title }}</strong>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Sección de Comunicados -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Comunicados</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($communications as $communication)
                                <li class="list-group-item border">
                                    <strong>{{ $communication->title }}</strong>
                                    <p>{{ $communication->content }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
