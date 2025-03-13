@extends('layouts.layout')

@section('content')
<div class="container-fluid container-custom">
    <!-- Usar el componente de breadcrumb -->
    <x-breadcrumb :items="[
        ['title' => 'Inicio', 'route' => 'dashboard'],
        ['title' => 'Listado de anuncios', 'route' => 'anuncios.index'],
        ['title' => 'Crear el anuncio', 'route' => 'anuncios.crear']
    ]"/>
    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold">Nuevo Anuncio</h2>
        </div>
    </div>
    
    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('anuncios.guardar') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                
                <div class="mb-3">
                    <label for="category" class="form-label">Categoría</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="" selected disabled>Seleccione una categoría</option>
                        <option value="General">General</option>
                        <option value="Evento">Evento</option>
                        <option value="Notificación">Notificación</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="priority" class="form-label">Prioridad</label>
                    <select class="form-select" id="priority" name="priority" required>
                        <option value="" selected disabled>Seleccione una prioridad</option>
                        <option value="Alta">Alta</option>
                        <option value="Media">Media</option>
                        <option value="Baja">Baja</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="author" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="author" name="author" required>
                </div>
                
                <div class="mb-3">
                    <label for="published_at" class="form-label">Fecha de Publicación</label>
                    <input type="date" class="form-control" id="published_at" name="published_at" required>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="{{ route('anuncios.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

