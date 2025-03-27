<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lato:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,0" rel="stylesheet" />

    <!-- Importación de Alpine.js y TailwindCSS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script src="{{ asset('resources/js/spinner.js') }}"></script>
    <style>
        body {
            font-family: 'Lato', sans-serif;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Sidebar -->
    <livewire:flux-sidebar />

    <!-- Main Content -->
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-60 pt-10">
        <!-- Page Content -->
        <main class="py-6 px-6">
            @isset($header)
                <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-6">
                    {{ $header }}
                </h1>
            @endisset
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>