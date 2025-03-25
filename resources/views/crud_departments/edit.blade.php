<x-app-layout>
    <div class="container-fluid container-custom">

        <!-- Usar el componente de breadcrumb -->
        <x-breadcrumb :items="[
        ['title' => 'Inicio', 'route' => 'dashboard'],
        ['title' => 'Listado de departamentos', 'route' => 'crud_departamentos.index'],
        ['title' => 'Editar el departamento: ' . $department->name, 'route' => 'departamentos.editar']
    ]" />

        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-primary text-white">
                Editar el departamento: <strong>{{ $department->name }}</strong>
            </div>
            @include('crud_departments.departments_form', ['route' => route('departamentos.actualizar', $department->id), 'method' => 'PUT', 'department' => $department, 'buttonText' => 'Actualizar'])
        </div>
    </div>
</x-app-layout>