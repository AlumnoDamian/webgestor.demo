<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <x-breadcrumb :items="[
            ['title' => 'Inicio', 'route' => 'dashboard'],
            ['title' => 'Listado de memos', 'route' => 'memos.index'],
            ['title' => 'Crear el memo', 'route' => 'memos.crear']
        ]" />

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Nuevo Memo</h2>
        </div>

        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6">
                <form action="{{ route('memos.guardar') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                        <input type="text" id="title" name="title" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                        <select id="type" name="type" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            <option value="" selected disabled>Seleccione un tipo</option>
                            <option value="Importante" class="text-red-600">Importante</option>
                            <option value="Informativo" class="text-blue-600">Informativo</option>
                            <option value="Urgente" class="text-yellow-600">Urgente</option>
                        </select>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Contenido</label>
                        <textarea id="content" name="content" rows="4" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 resize-none"></textarea>
                    </div>

                    <div>
                        <label for="recipient" class="block text-sm font-medium text-gray-700 mb-1">Destinatario</label>
                        <input type="text" id="recipient" name="recipient" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div>
                        <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Publicación</label>
                        <input type="date" id="published_at" name="published_at" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('memos.index') }}" 
                            class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-colors duration-200">
                            Cancelar
                        </a>
                        <button type="submit" 
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 inline-flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>