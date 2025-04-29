<!-- Modal de leyenda -->
<div id="legendModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="min-h-screen px-4 text-center">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" onclick="hideLegend()"></div>
        <span class="inline-block h-screen align-middle">&#8203;</span>
        <div class="inline-block w-full max-w-2xl p-6 my-8 text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl relative">
            <!-- Cabecera del modal -->
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Leyenda de Turnos</h3>
                <button type="button" onclick="hideLegend()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <span class="sr-only">Cerrar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Contenido del modal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Mañana -->
                <div class="flex items-center p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg border border-blue-200">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-blue-500 text-white rounded-lg font-bold text-lg shadow-sm">
                        MT
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-blue-800">Mañana</h4>
                        <p class="text-blue-600">08:00 - 16:00</p>
                    </div>
                </div>

                <!-- Tarde -->
                <div class="flex items-center p-4 bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg border border-indigo-200">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-indigo-500 text-white rounded-lg font-bold text-lg shadow-sm">
                        TT
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-indigo-800">Tarde</h4>
                        <p class="text-indigo-600">16:00 - 00:00</p>
                    </div>
                </div>

                <!-- Noche -->
                <div class="flex items-center p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg border border-purple-200">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-purple-500 text-white rounded-lg font-bold text-lg shadow-sm">
                        NT
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-purple-800">Noche</h4>
                        <p class="text-purple-600">00:00 - 08:00</p>
                    </div>
                </div>

                <!-- Vacaciones -->
                <div class="flex items-center p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border border-green-200">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-green-500 text-white rounded-lg font-bold text-lg shadow-sm">
                        VC
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-green-800">Vacaciones</h4>
                        <p class="text-green-600">Período vacacional</p>
                    </div>
                </div>

                <!-- Baja Médica -->
                <div class="flex items-center p-4 bg-gradient-to-r from-red-50 to-red-100 rounded-lg border border-red-200">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-red-500 text-white rounded-lg font-bold text-lg shadow-sm">
                        BM
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-red-800">Baja Médica</h4>
                        <p class="text-red-600">Ausencia por enfermedad</p>
                    </div>
                </div>

                <!-- Permiso -->
                <div class="flex items-center p-4 bg-gradient-to-r from-yellow-50 to-yellow-100 rounded-lg border border-yellow-200">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-yellow-500 text-white rounded-lg font-bold text-lg shadow-sm">
                        PM
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-yellow-800">Permiso</h4>
                        <p class="text-yellow-600">Ausencia autorizada</p>
                    </div>
                </div>

                <!-- Formación -->
                <div class="flex items-center p-4 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg border border-orange-200">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-orange-500 text-white rounded-lg font-bold text-lg shadow-sm">
                        FM
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-orange-800">Formación</h4>
                        <p class="text-orange-600">Capacitación</p>
                    </div>
                </div>

                <!-- Festivo -->
                <div class="flex items-center p-4 bg-gradient-to-r from-teal-50 to-teal-100 rounded-lg border border-teal-200">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-teal-500 text-white rounded-lg font-bold text-lg shadow-sm">
                        FT
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-teal-800">Festivo</h4>
                        <p class="text-teal-600">Día festivo</p>
                    </div>
                </div>

                <!-- Asuntos Propios -->
                <div class="flex items-center p-4 bg-gradient-to-r from-pink-50 to-pink-100 rounded-lg border border-pink-200">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-pink-500 text-white rounded-lg font-bold text-lg shadow-sm">
                        AP
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-pink-800">Asuntos Propios</h4>
                        <p class="text-pink-600">Día personal</p>
                    </div>
                </div>

                <!-- Día Libre -->
                <div class="flex items-center p-4 bg-gradient-to-r from-lime-50 to-lime-100 rounded-lg border border-lime-200">
                    <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center bg-lime-500 text-white rounded-lg font-bold text-lg shadow-sm">
                        DL
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-semibold text-lime-800">Día Libre</h4>
                        <p class="text-lime-600">Descanso programado</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
