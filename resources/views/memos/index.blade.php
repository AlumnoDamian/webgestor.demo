<x-app-layout>
    <div class="container-fluid container-custom">

        <!-- Usar el componente de breadcrumb -->
        <x-breadcrumb :items="[
        ['title' => 'Inicio', 'route' => 'dashboard'],
        ['title' => 'Listado de memos', 'route' => 'memos.index'],
    ]" />

        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold">Comunicados</h2>
            </div>
            <div class="col-auto">
                <a href="{{ route('memos.crear') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Nuevo Comunicado
                </a>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                @foreach($memos as $memo)
                    <div class="card mb-3 
                            @if($memo->type == 'Importante') border-danger bg-danger bg-opacity-10 @endif
                            @if($memo->type == 'Informativo') border-primary bg-primary bg-opacity-10 @endif
                            @if($memo->type == 'Urgente') border-warning bg-warning bg-opacity-10 @endif
                        ">
                        <div class="card-body">
                            <h3 class="card-title fw-bold">{{ $memo->title }}</h3>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="badge 
                                        @if($memo->type == 'Importante') bg-danger @endif
                                        @if($memo->type == 'Informativo') bg-primary @endif
                                        @if($memo->type == 'Urgente') bg-warning text-dark @endif
                                    ">{{ $memo->type }}</span>
                                <small class="text-muted">Publicado: {{ $memo->published_at }}</small>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-2">
                                        <strong>Contenido:</strong>
                                        <p>{{ $memo->content }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <strong>Destinatario:</strong>
                                        <p>{{ $memo->recipient }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>