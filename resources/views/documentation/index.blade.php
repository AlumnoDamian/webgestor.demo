<x-app-layout>
    <div class="container-fluid container-custom">

        <!-- Usar el componente de breadcrumb -->
        <x-breadcrumb :items="[
        ['title' => 'Inicio', 'route' => 'dashboard'],
        ['title' => 'Mi documentación', 'route' => 'documentacion.index']
    ]" />

        <div class="row g-4 justify-content-center mb-4">
            <!-- Card 1 -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
                <div class="card shadow-sm hover-shadow-lg border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Nómina</h5>
                    </div>
                    <div class="card-body">
                        <p>Accede a tu nómina aquí.</p>
                        <a href="#" class="btn btn-outline-dark w-100">Ver <span class="arrow">→</span></a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
                <div class="card shadow-sm hover-shadow-lg border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Contratos</h5>
                    </div>
                    <div class="card-body">
                        <p>Consulta los contratos aquí.</p>
                        <a href="#" class="btn btn-outline-dark w-100">Ver <span class="arrow">→</span></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Card 3 -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
                <div class="card shadow-sm hover-shadow-lg border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Bajas médicas</h5>
                    </div>
                    <div class="card-body">
                        <p>Consulta las bajas médicas aquí.</p>
                        <a href="#" class="btn btn-outline-dark w-100">Ver <span class="arrow">→</span></a>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col-12 col-sm-6 col-md-3 mb-4">
                <div class="card shadow-sm hover-shadow-lg border-primary">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Certificados de cursos</h5>
                    </div>
                    <div class="card-body">
                        <p>Ver certificados de cursos realizados.</p>
                        <a href="#" class="btn btn-outline-dark w-100">Ver <span class="arrow">→</span></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>