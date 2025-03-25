<x-app-layout>
    <div class="container-fluid container-custom">
        <div class="card mb-3">
            <div class="card-header">
                Datos personales
            </div>
            <div class="card-body d-flex">
                <div class="me-3">
                    <img src="{{ asset('storage/' . $employee->image) }}" class="img-thumbnail" alt="Foto de perfil"
                        width="150">
                </div>
                <div>
                    <p><strong>Nombre:</strong> {{ $employee->name }}</p>
                    <p><strong>DNI:</strong> {{ $employee->dni }}</p>
                    <p><strong>Email:</strong> {{ $employee->email }}</p>
                    <p><strong>Teléfono:</strong> {{ $employee->phone }}</p>
                    <p><strong>Fecha de nacimiento:</strong> {{ $employee->birth_date }}</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Dirección e información del empleado
            </div>
            <div class="card-body">
                <p><strong>Dirección:</strong> {{ $employee->address }}</p>
                <p><strong>Estado:</strong> {{ $employee->is_active ? 'Activo' : 'Inactivo' }}</p>
            </div>
        </div>
    </div>
</x-app-layout>