<x-app-layout>
    <div class="container-fluid container-custom">

        <!-- Usar el componente de breadcrumb -->
        <x-breadcrumb :items="[
        ['title' => 'Inicio', 'route' => 'dashboard'],
        ['title' => 'Listado de empleado', 'route' => 'empleados.index'],
        ['title' => 'Crear el empleado', 'route' => 'empleados.crear']
    ]" />

        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-primary text-white">Crear un empleado</div>
            @include('crud_employees.employees_form', ['route' => route('empleados.guardar'), 'buttonText' => 'Guardar'])
        </div>
    </div>
</x-app-layout>