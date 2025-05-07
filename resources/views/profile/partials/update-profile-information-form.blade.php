<section>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-4">
            <!-- Nombre -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" class="text-gray-700 font-medium" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <x-text-input 
                        id="name" 
                        name="name" 
                        type="text" 
                        class="mt-1 block w-full pl-10 pr-4 py-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200" 
                        :value="old('name', $user->name)" 
                        required 
                        autofocus 
                        autocomplete="name"
                        placeholder="{{ __('Ingresa tu nombre completo') }}"
                    />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Correo Electrónico -->
            <div>
                <x-input-label for="email" :value="__('Correo Electrónico')" class="text-gray-700 font-medium" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <x-text-input 
                        id="email" 
                        name="email" 
                        type="email" 
                        class="mt-1 block w-full pl-10 pr-4 py-2 border-gray-300 rounded-lg focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-colors duration-200" 
                        :value="old('email', $user->email)" 
                        required 
                        autocomplete="username"
                        placeholder="{{ __('Ingresa tu correo electrónico') }}"
                    />
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2 flex items-center space-x-2 text-sm">
                        <svg class="h-5 w-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span class="text-gray-700">{{ __('Tu correo electrónico no está verificado.') }}</span>
                        <button form="send-verification" class="text-indigo-600 hover:text-indigo-500 font-medium">
                            {{ __('Reenviar correo de verificación') }}
                        </button>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="mt-2 flex items-center space-x-2 text-sm">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-green-600 font-medium">
                                {{ __('Se ha enviado un nuevo enlace de verificación a tu correo electrónico.') }}
                            </span>
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <x-primary-button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ __('Guardar Cambios') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 flex items-center"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ __('Cambios guardados correctamente.') }}
                </p>
            @endif
        </div>
    </form>
</section>
