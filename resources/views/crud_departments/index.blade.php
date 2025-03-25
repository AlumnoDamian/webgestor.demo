<x-app-layout>
    <div class="container-fluid container-custom">

        <!-- Usar el componente de breadcrumb -->
        <x-breadcrumb :items="[
        ['title' => 'Inicio', 'route' => 'dashboard'],
        ['title' => 'Listado de departamentos', 'route' => 'crud_departamentos.index'],
    ]" />

        <div class="card shadow-sm hover-shadow-lg">
            <div class="card-header bg-primary text-white">Listado de departamentos</div>
            <div class="card-body">
                <a href="{{ route('departamentos.crear') }}"
                    class="btn btn-primary mb-3 d-inline-block shadow-md hover-shadow-lg">
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
                                    <td>{{ $department->manager ? $department->manager->name : 'No asignado' }}</td>
                                    <!-- Mostrar el nombre del jefe -->
                                    <td>
                                        <span class="badge {{ $department->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $department->status ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('departamentos.editar', $department->id) }}"
                                            class="btn btn-warning btn-sm shadow-sm hover-shadow-lg">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('departamentos.eliminar', $department->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm shadow-sm hover-shadow-lg"
                                                onclick="return confirm('¿Seguro que deseas eliminar este departamento?');">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('departamentos.show', $department->id) }}"
                                            class="btn btn-primary btn-sm shadow-sm hover-shadow-lg">
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
</x-app-layout>