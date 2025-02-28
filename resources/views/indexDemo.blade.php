<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-blue-500 p-4 text-white text-center">
        <h1 class="text-2xl font-semibold">Bienvenido al Dashboard</h1>
    </header>

    <!-- Card principal -->
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white dark:bg-gray-800 w-full max-w-lg p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold text-center text-gray-800 dark:text-gray-200 mb-4">¡Estás conectado!</h2>
            <p class="text-center text-gray-600 dark:text-gray-400 mb-6">Has iniciado sesión correctamente. Haz clic en el botón para ir a la página principal.</p>
            <div class="flex justify-center">
                <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">Ir a la Página Principal</a>
            </div>
        </div>
    </div>

</body>

</html>
