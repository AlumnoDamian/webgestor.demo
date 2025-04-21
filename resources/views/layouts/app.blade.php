<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lato:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,0" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Importación de Alpine.js y TailwindCSS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    <style>
        * {
            font-family: 'Lato', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }

        /* Ocultar scrollbar del body */
        body {
            overflow: hidden;
        }

        /* Personalización del scrollbar */
        .custom-scrollbar {
            scrollbar-width: thin;
        }
        
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(203, 213, 225, 0.3);
            border-radius: 20px;
        }
        
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(203, 213, 225, 0.5);
        }
    </style>
</head>

<body class="font-sans antialiased h-full">
    <!-- Sidebar -->
    <livewire:flux-sidebar />

    <!-- Main Content -->
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-60 py-10">
        <!-- Page Content -->
        <main class="h-screen overflow-y-auto custom-scrollbar">
            <div class="py-6 px-6">
                @isset($header)
                    <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                        {{ $header }}
                    </h1>
                @endisset
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>