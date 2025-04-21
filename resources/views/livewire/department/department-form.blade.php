<div>
    @if (session()->has('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-3 gap-8">
            <!-- Código -->
            <div>
                <label for="code" class="block text-base font-medium text-gray-700 mb-2">Código</label>
                <input type="text" wire:model="code" id="code"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                @error('code') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Nombre -->
            <div>
                <label for="name" class="block text-base font-medium text-gray-700 mb-2">Nombre</label>
                <input type="text" wire:model="name" id="name"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                @error('name') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-base font-medium text-gray-700 mb-2">Email</label>
                <input type="email" wire:model="email" id="email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                @error('email') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Teléfono -->
            <div>
                <label for="phone" class="block text-base font-medium text-gray-700 mb-2">Teléfono</label>
                <input type="tel" wire:model="phone" id="phone"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                @error('phone') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>


            <!-- Jefe de Departamento -->
            <div>
                <label for="manager_id" class="block text-base font-medium text-gray-700 mb-2">Jefe de Departamento</label>
                <select wire:model="manager_id" id="manager_id"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                    <option value="">Seleccionar...</option>
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                    @endforeach
                </select>
                @error('manager_id') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Presupuesto -->
            <div>
                <label for="budget" class="block text-base font-medium text-gray-700 mb-2">Presupuesto</label>
                <input type="number" wire:model="budget" id="budget" step="0.01"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                @error('budget') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Descripción -->
            <div class="col-span-3">
                <label for="description" class="block text-base font-medium text-gray-700 mb-2">Descripción</label>
                <textarea wire:model="description" id="description" rows="3"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base"></textarea>
                @error('description') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Estado -->
            <div class="col-span-3 flex items-center mt-4 bg-gray-50 p-4 rounded-lg">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" wire:model="status" id="status" class="sr-only peer">
                    <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                    <span class="ml-3 text-base font-medium text-gray-700">Estado del Departamento</span>
                </label>
                <div class="ml-3">
                    <span class="text-sm {{ $status ? 'text-green-600' : 'text-red-600' }}">
                        {{ $status ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
                @error('status') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" wire:click="closeModal"
                class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancelar
            </button>
            <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ $isEditing ? 'Actualizar' : 'Crear' }}
            </button>
        </div>
    </form>
</div>