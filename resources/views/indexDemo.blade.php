<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        /* Efecto de sombra suave en el card */
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* Animación de fade-in */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-600 to-blue-900 text-white font-sans">

    <!-- Header -->
    <header class="text-center p-8">
        <h1 class="text-4xl font-extrabold animate__animated animate__fadeIn">Bienvenido al Dashboard</h1>
        <p class="text-xl mt-2">Tu portal de administración personal</p>
    </header>

    <!-- Card principal -->
    <div class="flex justify-center items-center min-h-screen fade-in">
        <div class="card bg-white text-gray-800 dark:bg-gray-800 w-full max-w-6xl p-12 rounded-2xl shadow-xl">
            <h2 class="text-4xl font-semibold text-center mb-6">¡Bienvenido!</h2>
            <p class="text-center text-lg mb-8">Aquí podrás acceder a nuestra demo la cual tiene todas sus funcionalidades operativas para que puedas probar todo lo que podemos proporcionarte.</p>

            <!-- Previsualización de la página destino clickeable -->
            <a href="{{ route('dashboard') }}" class="block bg-gray-100 border-2 border-blue-500 rounded-xl p-6 hover:bg-blue-50 transition duration-300">
                <h3 class="text-2xl font-semibold mb-4 text-center">Previsualización de la Página Principal</h3>
                <iframe src="{{ route('dashboard') }}" class="w-full h-80 border-none rounded-xl shadow-lg" title="Vista Previa de la Página Principal"></iframe>
            </a>
        </div>
    </div>

</body>

</html>
