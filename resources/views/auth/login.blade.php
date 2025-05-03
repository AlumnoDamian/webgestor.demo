<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Correo electrónico')"
                class="text-lg font-medium text-gray-700 dark:text-gray-300" />
            <div class="mt-2 relative">
                <x-text-input id="email"
                    class="block w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm @error('email') border-red-500 dark:border-red-400 ring-red-500 @enderror"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    autocomplete="username"
                    placeholder="nombre@empresa.com" />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 @error('email') text-red-500 dark:text-red-400 @else text-gray-400 @enderror"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Contraseña')"
                class="text-lg font-medium text-gray-700 dark:text-gray-300" />
            <div class="mt-2 relative">
                <x-text-input id="password"
                    class="block w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 bg-white dark:bg-gray-800 text-gray-900 dark:text-white shadow-sm @error('password') border-red-500 dark:border-red-400 ring-red-500 @enderror"
                    type="password"
                    name="password"
                    placeholder="••••••••"
                    autocomplete="current-password" />
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 @error('password') text-red-500 dark:text-red-400 @else text-gray-400 @enderror"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Recordar sesión') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 no-underline">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif
        </div>

        <div class="flex gap-4">
            <x-primary-button onclick="window.location.href='{{ route('register') }}'" type="button" class="w-full justify-center py-3 px-4 text-base font-semibold bg-indigo-600 hover:bg-indigo-500">
                {{ __('Registrarse') }}
            </x-primary-button>
            <x-primary-button class="w-full justify-center py-3 px-4 text-base font-semibold bg-gray-900 hover:bg-gray-800">
                {{ __('Iniciar sesión') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>