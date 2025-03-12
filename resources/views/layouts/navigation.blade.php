<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar con Sidebar</title>
    <!-- Importación de Alpine.js y TailwindCSS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Estilos personalizados para Navbar */
        .navbar-custom {
            background-color: #2D89EF; /* Color azul personalizado */
        }

        .navbar-custom .navbar-nav .nav-link {
            color: white !important; /* Color blanco para los enlaces */
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            color: #ffd700 !important; /* Color dorado en hover */
        }

        /* Estilo personalizado para sidebar */
        .sidebar-custom {
            background-color: #343a40; /* Color de fondo oscuro para el sidebar */
            color: #fff;
        }

        .sidebar-custom a {
            color: #ccc;
        }

        .sidebar-custom a:hover {
            color: #ffffff;
            background-color: #007bff;
        }

        /* Estilo para los botones de cierre del sidebar */
        .sidebar-close-btn {
            color: #fff;
            background-color: transparent;
            border: none;
            font-size: 1.5rem;
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <div x-data="{ openSidebar: false }">
        <!-- Navbar superior con estilo personalizado -->
        <nav class="navbar-custom">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Botón para abrir el sidebar -->
                    <button @click="openSidebar = !openSidebar"
                        class="text-white p-2 rounded-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <!-- Título o logo del sitio -->
                    <a href="#" class="text-lg font-semibold text-white">Mi App</a>             
                </div>
            </div>
        </nav>

        <!-- Sidebar lateral izquierdo con estilo personalizado -->
        <div x-show="openSidebar" class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="openSidebar = false"></div>
        
        <div x-show="openSidebar" x-transition 
            class="fixed left-0 top-0 h-full w-80 sidebar-custom z-50 p-4 transform -translate-x-full"
            :class="{ 'translate-x-0': openSidebar }">
            <div class="flex justify-between items-center mb-4">
                <!-- Logo en el sidebar -->
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto"> 
                <!-- Botón para cerrar el sidebar -->
                <button @click="openSidebar = false" class="sidebar-close-btn">
                    ✖
                </button>
            </div>
            <ul>
                <!-- Enlaces del sidebar con estilo personalizado -->
                <li><a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-blue-500">Inicio</a></li>
                <li><a href="{{ route('profile.index') }}" class="block px-4 py-2 hover:bg-blue-500">Perfil</a></li>
                <li><a href="{{ route('empleados.index') }}" class="block px-4 py-2 hover:bg-blue-500">Listado empleados</a></li>
                <li><a href="{{ route('crud_departamentos.index') }}" class="block px-4 py-2 hover:bg-blue-500">Listado departamentos</a></li>
                <li><a href="{{ route('cuadrante.index') }}" class="block px-4 py-2 hover:bg-blue-500">Cuadrante</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-blue-500">Configuración</a></li>
                <!-- Cerrar sesión con formulario -->
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 dark:text-red-400 hover:bg-gray-200 dark:hover:bg-gray-700">
                            Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

</body>
</html>
