@extends('layouts.layout')

@section('content')
<div class="container-fluid container-custom">
    <!-- Usar el componente de breadcrumb -->
    <x-breadcrumb :items="[
        ['title' => 'Inicio', 'route' => 'dashboard'],
        ['title' => 'Listado de anuncios', 'route' => 'anuncios.index']
    ]"/>

    <div class="row mb-4">
        <div class="col">
            <h2 class="fw-bold">Anuncios</h2>
        </div>
        <div class="col-auto">
            <a href="{{ route('anuncios.crear') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Nuevo Anuncio
            </a>
        </div>
    </div>
    
    <div class="card shadow">
        <div class="card-body">
            @foreach($announcements as $announcement)
                <div class="card mb-3 
                    @if($announcement->category == 'Evento') border-warning bg-warning bg-opacity-10 @endif
                    @if($announcement->category == 'Notificación') border-danger bg-danger bg-opacity-10 @endif
                    @if($announcement->category == 'General') border-primary bg-primary bg-opacity-10 @endif
                ">
                    <div class="card-body">
                        <h3 class="card-title fw-bold">{{ $announcement->title }}</h3>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="badge 
                                @if($announcement->category == 'Evento') bg-warning text-dark @endif
                                @if($announcement->category == 'Notificación') bg-danger @endif
                                @if($announcement->category == 'General') bg-primary @endif
                            ">{{ $announcement->category }}</span>
                            <small class="text-muted">{{ $announcement->published_at }}</small>
                        </div>
                        <p class="card-text">{{ $announcement->content }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span>
                                Prioridad: 
                                <span class="badge 
                                    @if($announcement->priority == 'Alta') bg-danger @endif
                                    @if($announcement->priority == 'Media') bg-warning text-dark @endif
                                    @if($announcement->priority == 'Baja') bg-success @endif
                                ">{{ $announcement->priority }}</span>
                            </span>
                            <span class="text-muted">Autor: <strong>{{ $announcement->author }}</strong></span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
