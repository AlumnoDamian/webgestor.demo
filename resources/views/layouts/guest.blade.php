<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WebGestor') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lato:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Importación de Alpine.js y TailwindCSS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            font-family: 'Lato', sans-serif;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M54.627 0l.83.828-1.415 1.415L51.8 0h2.827zM5.373 0l-.83.828L5.96 2.243 8.2 0H5.374zM48.97 0l3.657 3.657-1.414 1.414L46.143 0h2.828zM11.03 0L7.372 3.657 8.787 5.07 13.857 0H11.03zm32.284 0L49.8 6.485 48.384 7.9l-7.9-7.9h2.83zM16.686 0L10.2 6.485 11.616 7.9l7.9-7.9h-2.83zM22.343 0L13.858 8.485 15.272 9.9l7.9-7.9h-.828zm5.657 0L19.515 8.485 20.93 9.9l8.485-8.485h-1.414zM32.657 0L26.172 6.485 27.586 7.9l5.657-5.657h-.586zm5.657 0l-7.071 7.071 1.414 1.414L40 0h-1.686zM42.97 0L36.485 6.485 37.9 7.9l6.485-6.485h-1.414zm5.657 0l-7.071 7.071 1.414 1.414L50 0h-1.343zm5.657 0l-7.071 7.071 1.414 1.414L60 0h-5.657zM5.373 0L0 5.373v2.827l6.485-6.485L5.373 0zm48.97 0l-6.485 6.485 1.414 1.414L60 2.828V0h-5.657zM0 8.2v2.827l8.485-8.485L7.07 1.128 0 8.2zm0 5.657v2.827l8.485-8.485L7.07 6.785 0 13.857zm0 5.657v2.827l8.485-8.485L7.07 12.442 0 19.514zm0 5.657v2.827l8.485-8.485L7.07 18.1 0 25.171zm0 5.657v2.827l8.485-8.485L7.07 23.757 0 30.828zm0 5.657v2.827l8.485-8.485L7.07 29.414 0 36.485zm0 5.657v2.827l8.485-8.485L7.07 35.071 0 42.142zm0 5.657v2.827l8.485-8.485L7.07 40.728 0 47.8zm0 5.657v2.827l8.485-8.485L7.07 46.385 0 53.456zm0 5.657v.343l8.485-8.485L7.07 52.042 0 59.113zM60 5.373v2.827l-6.485-6.485 1.414-1.414L60 5.373zm0 5.657v2.827l-6.485-6.485 1.414-1.414L60 11.03zm0 5.657v2.827l-6.485-6.485 1.414-1.414L60 16.686zm0 5.657v2.827l-6.485-6.485 1.414-1.414L60 22.343zm0 5.657v2.827l-6.485-6.485 1.414-1.414L60 28zm0 5.657v2.827l-6.485-6.485 1.414-1.414L60 33.657zm0 5.657v2.827l-6.485-6.485 1.414-1.414L60 39.314zm0 5.657v2.827l-6.485-6.485 1.414-1.414L60 44.97zm0 5.657v2.827l-6.485-6.485 1.414-1.414L60 50.627zm0 5.657v.343l-6.485-6.485 1.414-1.414L60 56.284zM39.314 0L0 39.314v2.827l41.728-41.728L40.314 0h-1zm5.657 0L0 44.97v2.827l47.385-47.385L46.97 0h-2zm11.314 0L0 50.627v2.827l52.97-52.97L51.557 0h-1.228zm5.657 0L0 56.284v2.827l58.627-58.627L57.213 0h-1.228zM0 58.627v.343L59.97.97 58.557 0h-1.228L0 58.627zm60 .343v-.343L1.373 0H0v.97L60 58.97z' fill='%239C92AC' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
    </style>
</head>

<body class="font-sans antialiased h-full">


    <div class="min-h-screen flex">
        <!-- Left side - Login Form -->
        <div
            class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 bg-white dark:bg-gray-900 transition-colors duration-300">
            <div class="w-full max-w-lg">
                <div class="text-center mb-12">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-24 animate-float">
                    <h2 class="mt-6 text-3xl font-bold text-gray-900 dark:text-white">
                        Bienvenido a WebGestor
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Tu solución integral para la gestión empresarial
                    </p>
                </div>

                {{ $slot }}
            </div>
        </div>

        <!-- Right side - Decorative -->
        <div class="hidden lg:flex lg:w-1/2 bg-indigo-600 relative overflow-hidden bg-pattern">
            <!-- Animated background elements -->
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-600 via-purple-600 to-blue-700 opacity-90"></div>
            <div class="absolute inset-0 bg-pattern opacity-10"></div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-center items-center text-white p-16">
                <div class="max-w-xl space-y-8">
                    <h2 class="text-4xl font-bold mb-8">
                        Gestión Empresarial Inteligente
                    </h2>

                    <p class="text-xl text-indigo-100 leading-relaxed">
                        Optimiza y automatiza tus procesos empresariales con nuestra plataforma integral de gestión.
                        Diseñada para hacer crecer tu negocio.
                    </p>

                    <div class="space-y-6 mt-12">
                        <div class="flex items-center space-x-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold">Control Financiero Total</h3>
                                <p class="text-lg text-indigo-100 mt-1">Gestiona ingresos, gastos y flujo de caja en
                                    tiempo real</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold">Gestión de Inventario Avanzada</h3>
                                <p class="text-indigo-100 mt-1">Control preciso de stock y alertas automáticas</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold">Reportes Inteligentes</h3>
                                <p class="text-indigo-100 mt-1">Análisis detallado y visualización de datos en tiempo
                                    real</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="absolute bottom-0 right-0 p-8">
                <div class="text-white/60 text-base">
                    {{ date('Y') }} WebGestor. Transformando la gestión empresarial.
                </div>
            </div>
        </div>
    </div>
</body>

</html>