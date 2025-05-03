<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')"
                class="text-lg font-medium text-gray-700 dark:text-gray-300" />
            <div class="mt-2 relative">
                <x-text-input id="email"
                    class="block w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm"
                    type="email" name="email" :value="old('email')" autofocus placeholder="nombre@empresa.com" />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col space-y-4">
            <x-primary-button
                class="w-full justify-center py-3 px-4 mb-2 text-base font-semibold bg-gray-900 hover:bg-gray-800">
                {{ __('Enviar enlace de restablecimiento') }}
            </x-primary-button>

            <x-primary-button onclick="window.location.href='{{ route('login') }}'" type="button"
                class="w-full justify-center py-3 px-4 text-base font-semibold bg-indigo-600 hover:bg-indigo-500">
                {{ __('Volver al inicio de sesión') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>