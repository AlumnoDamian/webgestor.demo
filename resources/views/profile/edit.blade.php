<x-app-layout>
    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-12">
            <div class="mb-8 px-4">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ __('Configuración de la Cuenta') }}
                </h1>
                <p class="mt-2 text-sm text-gray-600">
                    {{ __('Gestiona la configuración y seguridad de tu cuenta.') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4 auto-rows-auto">
                <!-- Información del Perfil -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-all duration-300 h-fit">
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-indigo-100 rounded-lg">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900">
                                {{ __('Información del Perfil') }}
                            </h2>
                        </div>
                        <div class="border-t border-gray-100 -mx-8 px-8 py-4 bg-gray-50">
                            <p class="text-sm text-gray-600">
                                {{ __("Actualiza tu información personal y correo electrónico.") }}
                            </p>
                        </div>
                        <div class="mt-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Actualizar Contraseña -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-all duration-300 h-fit">
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-emerald-100 rounded-lg">
                                <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900">
                                {{ __('Actualizar Contraseña') }}
                            </h2>
                        </div>
                        <div class="border-t border-gray-100 -mx-8 px-8 py-4 bg-gray-50">
                            <p class="text-sm text-gray-600">
                                {{ __('Asegúrate de usar una contraseña segura para proteger tu cuenta.') }}
                            </p>
                        </div>
                        <div class="mt-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Eliminar Cuenta -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-all duration-300 h-fit">
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-red-100 rounded-lg">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </div>
                            <h2 class="text-xl font-semibold text-gray-900">
                                {{ __('Eliminar Cuenta') }}
                            </h2>
                        </div>
                        <div class="border-t border-gray-100 -mx-8 px-8 py-4 bg-gray-50">
                            <p class="text-sm text-gray-600">
                                {{ __('Una vez eliminada, todos los recursos y datos se perderán permanentemente.') }}
                            </p>
                        </div>
                        <div class="mt-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
