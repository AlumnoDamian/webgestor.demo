<div>
    <form wire:submit.prevent="save" class="bg-white">
        <div class="px-6 py-6 space-y-8">
            <!-- Información Básica -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">
                    Información Básica
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <!-- Código y Nombre en la primera fila -->
                    <div class="md:col-span-3 group">
                        <label for="code" class="block text-sm font-medium leading-6 text-gray-900">
                            Código del Departamento <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" wire:model="code" id="code" 
                                class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('code') ring-red-600 @enderror" 
                                placeholder="Código del departamento">
                            <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/20"></div>
                        </div>
                        @error('code') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-9 group">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">
                            Nombre del Departamento <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" wire:model="name" id="name" 
                                class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') ring-red-600 @enderror" 
                                placeholder="Nombre del departamento">
                            <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/20"></div>
                        </div>
                        @error('name') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Estado en la segunda fila -->
                    <div class="md:col-span-12 group bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model="status" id="status" class="sr-only peer" @checked($status)>
                                <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                                <span class="ml-3 text-base font-medium text-gray-700">Estado del Departamento <span class="text-red-600">*</span></span>
                            </label>
                            <span class="text-sm font-medium {{ $status ? 'text-green-600' : 'text-red-600' }}">
                                {{ $status ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                        @error('status') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Gestión y Contacto -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">
                    Gestión y Contacto
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <!-- Jefe y Presupuesto en la primera fila -->
                    <div class="md:col-span-6 group">
                        <label for="manager_id" class="block text-sm font-medium leading-6 text-gray-900">
                            Jefe de Departamento
                        </label>
                        <div class="mt-2">
                            <select wire:model="manager_id" id="manager_id" 
                                class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('manager_id') ring-red-600 @enderror">
                                <option value="">Seleccionar Jefe</option>
                                @foreach($managers as $manager)
                                    <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/20"></div>
                        </div>
                        @error('manager_id') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-6 group">
                        <label for="budget" class="block text-sm font-medium leading-6 text-gray-900">
                            Presupuesto
                        </label>
                        <div class="mt-2">
                            <input type="number" wire:model="budget" id="budget" step="0.01" 
                                class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('budget') ring-red-600 @enderror" 
                                placeholder="0.00">
                            <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/20"></div>
                        </div>
                        @error('budget') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Teléfono y Email en la segunda fila -->
                    <div class="md:col-span-6 group">
                        <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">
                            Teléfono
                        </label>
                        <div class="mt-2">
                            <input type="tel" wire:model="phone" id="phone" 
                                class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('phone') ring-red-600 @enderror" 
                                placeholder="123456789">
                            <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/20"></div>
                        </div>
                        @error('phone') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-6 group">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                            Email del Departamento <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="email" wire:model="email" id="email" 
                                class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('email') ring-red-600 @enderror" 
                                placeholder="departamento@ejemplo.com">
                            <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/20"></div>
                        </div>
                        @error('email') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Descripción -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">
                    Descripción
                </h3>
                <div class="group">
                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">
                        Descripción
                    </label>
                    <div class="mt-2">
                        <textarea wire:model="description" id="description" rows="4" 
                            class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('description') ring-red-600 @enderror"
                            placeholder="Describe las funciones y objetivos del departamento..."></textarea>
                        <div class="absolute inset-0 rounded-lg shadow-sm pointer-events-none transition-all duration-200 group-focus-within:shadow-md group-focus-within:shadow-indigo-500/20"></div>
                    </div>
                    @error('description') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Footer con efecto de vidrio -->
        <div class="px-6 py-4 bg-gray-50/80 backdrop-blur-sm border-t border-gray-100 flex justify-end space-x-3">
            <button type="button" wire:click="dispatch('closeModal')"
                class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 border border-gray-300 rounded-lg hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200">
                Cancelar
            </button>
            <button type="submit"
                class="px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 
                       hover:from-blue-700 hover:via-indigo-700 hover:to-indigo-800 
                       rounded-lg shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                       transition-all duration-200 transform hover:-translate-y-0.5">
                {{ $isEditing ? 'Actualizar' : 'Crear' }}
            </button>
        </div>
    </form>
</div>