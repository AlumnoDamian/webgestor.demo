<x-app-layout>
    <div class="container-fluid container-custom">

        <!-- Usar el componente de breadcrumb -->
        <x-breadcrumb :items="[
        ['title' => 'Inicio', 'route' => 'dashboard'],
        ['title' => 'Listado de memos', 'route' => 'memos.index'],
        ['title' => 'Crear el memo', 'route' => 'memos.crear']
    ]" />

        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold">Nuevo Memo</h2>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('memos.guardar') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="" selected disabled>Seleccione un tipo</option>
                            <option value="Importante">Importante</option>
                            <option value="Informativo">Informativo</option>
                            <option value="Urgente">Urgente</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenido</label>
                        <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="recipient" class="form-label">Destinatario</label>
                        <input type="text" class="form-control" id="recipient" name="recipient" required>
                    </div>

                    <div class="mb-3">
                        <label for="published_at" class="form-label">Fecha de Publicación</label>
                        <input type="date" class="form-control" id="published_at" name="published_at" required>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('memos.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>