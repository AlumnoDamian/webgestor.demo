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
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Título <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                            Tipo <span class="text-red-500">*</span>
                        </label>
                        <select id="type" name="type"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('type') border-red-500 @enderror">
                            <option value="" selected disabled>Seleccione un tipo</option>
                            <option value="Importante" class="text-red-600" {{ old('type') == 'Importante' ? 'selected' : '' }}>Importante</option>
                            <option value="Informativo" class="text-blue-600" {{ old('type') == 'Informativo' ? 'selected' : '' }}>Informativo</option>
                            <option value="Urgente" class="text-yellow-600" {{ old('type') == 'Urgente' ? 'selected' : '' }}>Urgente</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                            Contenido <span class="text-red-500">*</span>
                        </label>
                        <textarea id="content" name="content" rows="4"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 resize-none @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="department_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Departamento <span class="text-red-500">*</span>
                        </label>
                        <select id="department_id" name="department_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('department_id') border-red-500 @enderror">
                            <option value="" selected disabled>Seleccione un departamento</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
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