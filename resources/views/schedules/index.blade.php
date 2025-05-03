<x-app-layout>
    <div class="py-10">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-16">
            <form id="scheduleForm" action="{{ route('cuadrante.store') }}" method="POST">
                @csrf

                @include('schedules._header-actions', [
                    'departments' => $departments,
                    'selectedDepartment' => $selectedDepartment ?? null,
                    'employees' => $employees ?? collect()
                ])

                @if(!isset($employees) || $employees->count() == 0)
                    <!-- Mensaje cuando no hay empleados -->
                    @include('schedules._alert')
                @else
                    <!-- Botones de selección de semana -->
                    @include('schedules._select-weekend')
                    @include('schedules._schedule-table')
                @endif
            </form>

            @include('schedules._legend-modal')

            <script src="{{ asset('js/schedules.js') }}"></script>

        </div>
    </div>

</x-app-layout>