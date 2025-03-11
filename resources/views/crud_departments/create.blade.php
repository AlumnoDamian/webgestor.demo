@extends('layouts.layout')

@section('content')
<div class="container mt-2">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-0 shadow-sm p-2">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted hover-text-primary transition-all duration-300">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('departamentos.index') }}" class="text-muted hover-text-primary transition-all duration-300">Listado de departamentos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Crear un departamento</li>
        </ol>
    </nav>

    <div class="card shadow-lg rounded-lg">
        <div class="card-header bg-primary text-white">Crear un departamento</div>
        @include('crud_departments.departments_form', ['route' => route('departamentos.guardar'), 'buttonText' => 'Guardar'])
    </div>
</div>
@endsection
