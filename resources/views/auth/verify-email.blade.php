<x-guest-layout>
    <div class="mb-6 text-base text-gray-600 dark:text-gray-400">
        {{ __('¡Gracias por registrarte! Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte? Si no recibiste el correo, con gusto te enviaremos otro.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm bg-green-50 dark:bg-green-900 text-green-600 dark:text-green-400 p-4 rounded-lg">
            {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico proporcionada durante el registro.') }}
        </div>
    @endif

    <div class="flex flex-col space-y-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf

            <x-primary-button class="w-full justify-center py-3 px-4 text-base font-semibold">
                {{ __('Reenviar correo de verificación') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf

            <button type="submit"
                class="w-full justify-center py-3 px-4 text-base text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 transition-colors duration-200">
                {{ __('Cerrar sesión') }}
            </button>
        </form>
    </div>
</x-guest-layout>