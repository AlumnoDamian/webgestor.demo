            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
    <form wire:submit.prevent="save">
        <!-- Encabezado con botón de cierre -->
        <div class="bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 px-6 py-4 flex items-center justify-between">
            <h3 class="text-lg font-medium text-white">
                {{ $isEditing ? 'Editar Empleado' : 'Nuevo Empleado' }}
            </h3>
            <button type="button" wire:click="$dispatch('closeModal')" class="text-white/80 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="px-8 py-6 space-y-8">
            <!-- Imagen del Empleado -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">
                    Imagen del Empleado
                </h3>
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        @if($image)
                            <img class="h-24 w-24 rounded-full object-cover" src="{{ $image->temporaryUrl() }}" alt="Preview">
                        @elseif($isEditing && $employee->image)
                            <img class="h-24 w-24 rounded-full object-cover" src="{{ asset('storage/' . $employee->image) }}" alt="{{ $employee->name }}">
                        @else
                            <div class="h-24 w-24 rounded-full bg-gradient-to-br from-indigo-600 to-indigo-800 flex items-center justify-center">
                                <span class="text-white text-2xl font-medium">
                                    {{ $name ? substr($name, 0, 2) : 'NE' }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto de perfil</label>
                        <div class="mt-1 flex items-center space-x-4">
                            <input type="file" wire:model="image" id="image" class="hidden" accept="image/*">
                            <label for="image" class="px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer">
                                Cambiar imagen
                            </label>
                            @if($image || ($isEditing && $employee->image))
                                <button type="button" wire:click="removeImage" class="px-4 py-2 bg-red-50 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Eliminar
                                </button>
                            @endif
                        </div>
                        @error('image') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                        <p class="mt-2 text-sm text-gray-500">JPG, PNG o GIF. Máximo 1MB.</p>
                    </div>
                </div>
            </div>

            <!-- Información Personal -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">
                    Información Personal
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <!-- DNI y Nombre -->
                    <div class="md:col-span-3 group">
                        <label for="dni" class="block text-sm font-medium leading-6 text-gray-900">
                            DNI <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" wire:model="dni" id="dni" class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('dni') ring-red-600 @enderror" placeholder="12345678A">
                        </div>
                        @error('dni')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-5 group">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">
                            Nombre Completo <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" wire:model="name" id="name" class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('name') ring-red-600 @enderror" placeholder="Nombre del empleado">
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-4 group">
                        <label for="birth_date" class="block text-sm font-medium leading-6 text-gray-900">
                            Fecha de Nacimiento
                        </label>
                        <div class="mt-2">
                            <input type="date" wire:model="birth_date" id="birth_date" class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('birth_date') ring-red-600 @enderror">
                        </div>
                        @error('birth_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="md:col-span-12 group bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" wire:model="is_active" id="is_active" class="sr-only peer" @checked($is_active)>
                                <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600"></div>
                                <span class="ml-3 text-base font-medium text-gray-700">Estado del Empleado</span>
                            </label>
                            <span class="text-sm font-medium {{ $is_active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                        @error('is_active') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Información Laboral -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">
                    Información Laboral
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <!-- Departamento y Rol -->
                    <div class="md:col-span-6 group">
                        <label for="department_id" class="block text-sm font-medium leading-6 text-gray-900">
                            Departamento
                        </label>
                        <div class="mt-2">
                            <select wire:model="department_id" id="department_id" class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('department_id') ring-red-600 @enderror">
                                <option value="-">Seleccionar departamento</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('department_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 group">
                        <label for="role" class="block text-sm font-medium leading-6 text-gray-900">
                            Cargo
                        </label>
                        <div class="mt-2">
                            <select wire:model="role" id="role" class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('role') ring-red-600 @enderror">
                                <option value="-">Seleccionar cargo</option>
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
                        </div>
                        @error('role')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha de Ingreso -->
                    <div class="md:col-span-12 group">
                        <label for="hire_date" class="block text-sm font-medium leading-6 text-gray-900">
                            Fecha de Contratación
                        </label>
                        <div class="mt-2">
                            <input type="date" wire:model="hire_date" id="hire_date" class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('hire_date') ring-red-600 @enderror">
                        </div>
                        @error('hire_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Información de Contacto -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">
                    Información de Contacto
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-6 group">
                        <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">
                            Teléfono
                        </label>
                        <div class="mt-2">
                            <input type="tel" wire:model="phone" id="phone" class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('phone') ring-red-600 @enderror" placeholder="123456789">
                        </div>
                        @error('phone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 group">
                        <label for="address" class="block text-sm font-medium leading-6 text-gray-900">
                            Dirección
                        </label>
                        <div class="mt-2">
                            <textarea wire:model="address" id="address" rows="3" class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('address') ring-red-600 @enderror" placeholder="Dirección completa"></textarea>
                        </div>
                        @error('address')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Credenciales -->
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4 pb-2 border-b border-gray-200">
                    Credenciales
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <!-- Email -->
                    <div class="md:col-span-12 group">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                            Email <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="email" wire:model="email" id="email" class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('email') ring-red-600 @enderror" placeholder="correo@ejemplo.com">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="md:col-span-6 group">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                            Contraseña {{ $isEditing ? '(dejar en blanco para mantener)' : '' }} <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="password" wire:model="password" id="password" class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('password') ring-red-600 @enderror">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-6 group">
                        <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">
                            Confirmar Contraseña <span class="text-red-600">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="password" wire:model="password_confirmation" id="password_confirmation" class="block w-full rounded-md border-0 p-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('password_confirmation') ring-red-600 @enderror">
                        </div>
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3 rounded-b-lg">
                <button type="button" wire:click="$dispatch('closeModal')"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                    Cancelar
                </button>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 
                           hover:from-blue-700 hover:via-indigo-700 hover:to-indigo-800 
                           rounded-lg shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 
                           transition-all duration-200 transform hover:-translate-y-0.5">
                    {{ $isEditing ? 'Actualizar' : 'Crear' }} Empleado
                </button>
            </div>
        </div>
    </form>
</div>
