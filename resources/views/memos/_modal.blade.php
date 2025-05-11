<!-- Modal -->
<div id="memoModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay con blur -->
        <div class="fixed inset-0 bg-gray-500/75 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

        <!-- Modal panel -->
        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
            <form id="memoForm" method="POST" class="bg-white">
                @csrf
                <input type="hidden" name="_method" id="form_method" value="POST">
                <input type="hidden" id="memo_id" name="id">
                
                <!-- Header del modal con gradiente -->
                <div class="bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h3 id="modalTitle" class="text-xl font-semibold text-white tracking-wide">Nuevo Comunicado</h3>
                        <button type="button" onclick="closeModal()" class="text-white/80 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="px-6 py-6 space-y-6">
                    <!-- Título -->
                    <div class="group">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-indigo-600">
                            Título <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="title" name="title"
                                class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200 @error('title') border-red-500 @enderror">
                            <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/10"></div>
                        </div>
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tipo -->
                    <div class="group">
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-indigo-600">
                            Tipo <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="type" name="type"
                                class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200 @error('type') border-red-500 @enderror">
                                <option value="" selected disabled>Seleccione un tipo</option>
                                <option value="Importante">Importante</option>
                                <option value="Informativo">Informativo</option>
                                <option value="Urgente">Urgente</option>
                            </select>
                            <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/10"></div>
                        </div>
                        @error('type')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contenido -->
                    <div class="group">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-indigo-600">
                            Contenido <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <textarea id="content" name="content" rows="4"
                                class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200 @error('content') border-red-500 @enderror"></textarea>
                            <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/10"></div>
                        </div>
                        @error('content')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Departamento -->
                    <div class="group">
                        <label for="department_id" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-indigo-600">
                            Departamento Destinatario <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="department_id" name="department_id"
                                class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200 @error('department_id') border-red-500 @enderror">
                                <option value="" selected disabled>Seleccione un departamento</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/10"></div>
                        </div>
                        @error('department_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de Publicación -->
                    <div id="published_at_field" class="group">
                        <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1 group-focus-within:text-indigo-600">
                            Fecha de Publicación <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="datetime-local" id="published_at" name="published_at"
                                class="w-full rounded-lg border-gray-300 px-4 py-3 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition-all duration-200 @error('published_at') border-red-500 @enderror">
                            <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/10"></div>
                        </div>
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" 
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-colors duration-200">
                        Cancelar
                    </button>
                    <button type="submit" id="submitButton"
                        class="px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 hover:from-blue-700 hover:via-indigo-700 hover:to-indigo-800 border border-transparent rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500/50 transition-all duration-200 transform hover:-translate-y-0.5">
                        Crear Comunicado
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
