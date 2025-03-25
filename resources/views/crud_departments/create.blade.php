<x-app-layout>
    <div class="container-fluid container-custom">

        <!-- Usar el componente de breadcrumb -->
        <x-breadcrumb :items="[
        ['title' => 'Inicio', 'route' => 'dashboard'],
        ['title' => 'Listado de departamentos', 'route' => 'crud_departamentos.index'],
        ['title' => 'Crear un departamento', 'route' => 'departamentos.crear']
    ]" />

        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-primary text-white">Crear un departamento</div>
            @include('crud_departments.departments_form', ['route' => route('departamentos.guardar'), 'buttonText' => 'Guardar'])
        </div>
    </div>
</x-app-layout>