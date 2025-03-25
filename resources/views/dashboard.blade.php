<x-app-layout>
    <div class="container-fluid container-custom">

        <div class="row justify-content-center align-items-stretch">
            <!-- Perfil del Usuario -->
            <div class="col-md-4">
                <div class="card h-100 text-center">
                    <div class="card-header">
                        <h5>Perfil</h5>
                    </div>
                    <div class="card-body">
                        <img src="{{ $employee->image ? asset('storage/' . $employee->image) : 'https://via.placeholder.com/100' }}"
                            class="rounded-circle mb-3" alt="Foto de Perfil" width="100" height="100">
                        <h5>{{ $employee->name }}</h5>
                        <p>{{ $employee->email }}</p>
                    </div>
                </div>
            </div>

            <!-- Departamentos y Últimos Anuncios -->
            <div class="col-md-8">
                <div class="row gx-3">
                    @foreach ([['Departamentos', $departments], ['Últimos Anuncios', $announcements]] as [$title, $items])
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header text-center">
                                    <h5>{{ $title }}</h5>
                                </div>
                                <div class="card-body">
                                    @if ($items->isEmpty())
                                        <p class="text-center text-muted">No hay {{ strtolower($title) }} disponibles.</p>
                                    @else
                                        <ul class="list-group">
                                            @foreach ($items as $item)
                                                <li
                                                    class="list-group-item text-center mb-2 border {{ $title == 'Últimos Anuncios' ? 'bg-primary text-white' : '' }}">
                                                    <strong>{{ $item->name ?? $item->title }}</strong>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sección de Comunicados -->
        <div class="row mt-4">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>Comunicados</h5>
                    </div>
                    <div class="card-body">
                        @if ($communications->isEmpty())
                            <p class="text-center text-muted">No hay comunicados disponibles.</p>
                        @else
                            <ul class="list-group">
                                @foreach ($communications as $communication)
                                    <li class="list-group-item border">
                                        <strong>{{ $communication->title }}</strong>
                                        <p>{{ $communication->content }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>