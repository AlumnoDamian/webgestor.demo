@extends('layouts.layout')

@section('content')
<div class="container-fluid container-custom">
    
    <!-- Usar el componente de breadcrumb -->
    <x-breadcrumb :items="[
        ['title' => 'Inicio', 'route' => 'dashboard'],
        ['title' => 'Listado de empleados', 'route' => 'empleados.index'],
        ['title' => 'Editar el empleado', 'route' => 'empleados.crear']
    ]"/>

    <div class="card shadow-lg rounded-lg">
        <div class="card-header bg-primary text-white">Editar el empleado</div>
        @include('crud_employees.employees_form', ['route' => route('empleados.actualizar', $employee->id), 'method' => 'PUT', 'employee' => $employee, 'buttonText' => 'Actualizar'])
    </div>
</div>
@endsection
