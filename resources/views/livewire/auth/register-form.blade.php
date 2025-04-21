<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-r from-blue-500 to-purple-600">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
         x-data="{ loading: false }"
         x-on:livewire-loading.window="loading = true"
         x-on:livewire-load-end.window="loading = false">
        
        <div class="flex justify-center mb-6">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </div>

        <h2 class="text-2xl font-bold text-center text-gray-700 mb-8">Crear nueva cuenta</h2>

        <form wire:submit="register">
            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input wire:model="name" 
                             id="name" 
                             class="block mt-1 w-full" 
                             type="text" 
                             name="name" 
                             required 
                             autofocus 
                             autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input wire:model="email" 
                             id="email" 
                             class="block mt-1 w-full" 
                             type="email" 
                             name="email" 
                             required 
                             autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input wire:model="password" 
                             id="password" 
                             class="block mt-1 w-full"
                             type="password"
                             name="password"
                             required
                             autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input wire:model="password_confirmation" 
                             id="password_confirmation" 
                             class="block mt-1 w-full"
                             type="password"
                             name="password_confirmation" 
                             required 
                             autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" 
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4 relative" 
                                x-bind:disabled="loading">
                    <span x-show="loading" class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                    <span x-show="!loading">{{ __('Register') }}</span>
                    <span x-show="loading">{{ __('Loading...') }}</span>
                </x-primary-button>
            </div>
        </form>
    </div>
</div>
