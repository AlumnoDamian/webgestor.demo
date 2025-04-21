            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="p-6">
                    <!-- Encabezado -->
                    <div class="mb-6 border-b pb-4">
                        <h2 class="text-2xl font-semibold text-gray-800 mb-2">
                            {{ $isEditing ? 'Editar Empleado' : 'Crear Nuevo Empleado' }}
                        </h2>
                        <p class="text-sm text-gray-600">Complete todos los campos necesarios para {{ $isEditing ? 'actualizar' : 'registrar' }} el empleado</p>
                    </div>

                    <div>
                        @if (session()->has('message'))
                            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="save" class="space-y-6">
                            <div class="grid grid-cols-3 gap-8">
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

                                <!-- Contraseña -->
                                <div>
                                    <label for="password" class="block text-base font-medium text-gray-700 mb-2">Contraseña {{ $isEditing ? '(dejar en blanco para mantener)' : '' }}</label>
                                    <input type="password" wire:model="password" id="password"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                                    @error('password') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- DNI -->
                                <div>
                                    <label for="dni" class="block text-base font-medium text-gray-700 mb-2">DNI</label>
                                    <input type="text" wire:model="dni" id="dni"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                                    @error('dni') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Teléfono -->
                                <div>
                                    <label for="phone" class="block text-base font-medium text-gray-700 mb-2">Teléfono</label>
                                    <input type="tel" wire:model="phone" id="phone"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                                    @error('phone') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Departamento -->
                                <div>
                                    <label for="department_id" class="block text-base font-medium text-gray-700 mb-2">Departamento</label>
                                    <select wire:model="department_id" id="department_id"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                                        <option value="">Seleccionar...</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Rol -->
                                <div>
                                    <label for="role" class="block text-base font-medium text-gray-700 mb-2">Rol</label>
                                    <select wire:model="role" id="role"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                                        <option value="">Seleccionar...</option>
                                        <option value="jefe">Jefe</option>
                                        <option value="empleado">Empleado</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="auxiliar">Auxiliar</option>
                                        <option value="gerente">Gerente</option>
                                        <option value="recepcionista">Recepcionista</option>
                                        <option value="cocinero">Cocinero</option>
                                        <option value="camarero">Camarero</option>
                                        <option value="conserje">Conserje</option>
                                        <option value="limpiador">Limpiador</option>
                                        <option value="guardia de seguridad">Guardia de Seguridad</option>
                                        <option value="auxiliar administrativo">Auxiliar Administrativo</option>
                                        <option value="analista">Analista</option>
                                    </select>
                                    @error('role') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Fecha de Nacimiento -->
                                <div>
                                    <label for="birth_date" class="block text-base font-medium text-gray-700 mb-2">Fecha de Nacimiento</label>
                                    <input type="date" wire:model="birth_date" id="birth_date"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                                    @error('birth_date') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Dirección -->
                                <div>
                                    <label for="address" class="block text-base font-medium text-gray-700 mb-2">Dirección</label>
                                    <input type="text" wire:model="address" id="address"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-base py-3">
                                    @error('address') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Activo -->
                                <div class="flex items-center mt-8 bg-gray-50 p-4 rounded-lg">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" wire:model="is_active" id="is_active" class="sr-only peer" {{ $is_active ? 'checked' : '' }}>
                                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                                        <span class="ml-3 text-base font-medium text-gray-700">Estado del Empleado</span>
                                    </label>
                                    <div class="ml-3">
                                        <span class="text-sm {{ $is_active ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $is_active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </div>
                                    @error('is_active') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                                </div>

                            </div>

                            <!-- Imagen de Perfil -->
                            <div class="mt-8">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Imagen de Perfil</h3>
                                <div class="flex items-center justify-center w-full">
                                    <label for="image"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                        @if ($temporaryImage)
                                            <img src="{{ $temporaryImage->temporaryUrl() }}" class="max-h-60 rounded" alt="Vista previa">
                                        @elseif ($image && !$temporaryImage)
                                            <img src="{{ asset('storage/' . $image) }}" class="max-h-60 rounded" alt="Foto actual">
                                        @else
                                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                </svg>
                                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Haz clic para subir</span> o arrastra y suelta</p>
                                                <p class="text-xs text-gray-500">PNG, JPG o GIF (MAX. 2MB)</p>
                                            </div>
                                        @endif
                                        <input wire:model="image" id="image" type="file" class="hidden" accept="image/*" />
                                    </label>
                                </div>
                                @error('image') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Botones de Acción -->
                            <div class="flex justify-end space-x-3 mt-8 pt-4 border-t">
                                <button type="button" wire:click="cancel"
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ $isEditing ? 'Actualizar' : 'Crear' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
