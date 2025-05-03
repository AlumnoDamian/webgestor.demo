<div>
    <!-- Topbar con notificaciones y perfil -->
    <div class="fixed top-0 right-0 left-72 h-16 bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 shadow-md z-40 px-6">
        <div class="h-full flex items-center justify-end space-x-6">
            <div class="flex items-center space-x-4">
                <a href="{{ route('memos.index') }}" class="relative p-2 text-white/80 hover:text-white transition-colors duration-150">
                <span class="material-symbols-outlined text-2xl">notifications</span>
                    <span class="absolute top-1.5 right-1.5 block h-2 w-2 rounded-full bg-red-400 ring-2 ring-indigo-900"></span>
                </a>
                <div class="h-8 w-px bg-white/10"></div>
                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-white/5 transition-colors duration-150">
                    @if(Auth::user()->profile_photo_url)
                        <img class="h-8 w-8 rounded-full object-cover ring-2 ring-white/20" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                    @else
                        <div class="h-8 w-8 rounded-full bg-white/10 ring-2 ring-white/20 flex items-center justify-center">
                            <span class="material-symbols-outlined">person</span>
                        </div>
                    @endif
                    <span class="text-sm font-bold text-white/90">{{ Auth::user()->name }}</span>
                    <span class="material-symbols-outlined text-sm text-white/60">expand_more</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Sidebar estático -->
    <div class="fixed inset-y-0 left-0 w-72 bg-gradient-to-b from-blue-800 to-indigo-900 text-white shadow-xl z-50">
        <!-- Header con Logo -->
        <div class="p-2 border-b border-white/10">
            <div class="flex justify-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto">
            </div>
        </div>

        <!-- Enlaces del Sidebar -->
        <nav class="mt-4 px-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 {{ request()->routeIs('dashboard') ? 'bg-white/15 text-white' : 'text-white/80 hover:text-white hover:bg-white/10' }} rounded-lg group transition duration-150 ease-in-out">
                <span class="material-symbols-outlined w-8">dashboard</span>
                <span class="font-bold">Inicio</span>
            </a>
            
            @if(auth()->user()->employee)
                <a href="{{ route('perfil') }}" class="flex items-center px-4 py-2.5 {{ request()->routeIs('perfil') ? 'bg-white/15 text-white' : 'text-white/80 hover:text-white hover:bg-white/10' }} rounded-lg group transition duration-150 ease-in-out">
                    <span class="material-symbols-outlined w-8">badge</span>
                    <span class="font-bold">Ficha de empleado</span>
                </a>
            @endif
            
            <a href="{{ route('empleados.index') }}" class="flex items-center px-4 py-2.5 {{ request()->routeIs('empleados.*') ? 'bg-white/15 text-white' : 'text-white/80 hover:text-white hover:bg-white/10' }} rounded-lg group transition duration-150 ease-in-out">
                <span class="material-symbols-outlined w-8">group</span>
                <span class="font-bold">Empleados</span>
            </a>
            
            <a href="{{ route('departamentos.index') }}" class="flex items-center px-4 py-2.5 {{ request()->routeIs('departamentos.*') ? 'bg-white/15 text-white' : 'text-white/80 hover:text-white hover:bg-white/10' }} rounded-lg group transition duration-150 ease-in-out">
                <span class="material-symbols-outlined w-8">apartment</span>
                <span class="font-bold">Departamentos</span>
            </a>
            
            <a href="{{ route('cuadrante.show') }}" class="flex items-center px-4 py-2.5 {{ request()->routeIs('cuadrante.show') ? 'bg-white/15 text-white' : 'text-white/80 hover:text-white hover:bg-white/10' }} rounded-lg group transition duration-150 ease-in-out">
                <span class="material-symbols-outlined w-8">calendar_month</span>
                <span class="font-bold">Cuadrante</span>
            </a>

            @if(auth()->user()->employee)
                <a href="{{ route('cuadrante.view') }}" class="flex items-center px-4 py-2.5 {{ request()->routeIs('cuadrante.view') ? 'bg-white/15 text-white' : 'text-white/80 hover:text-white hover:bg-white/10' }} rounded-lg group transition duration-150 ease-in-out">
                    <span class="material-symbols-outlined w-8">schedule</span>
                    <span class="font-bold">Ver Horarios</span>
                </a>
            @endif
            
        </nav>

        <!-- Footer del Sidebar -->
        <div class="absolute bottom-0 w-full p-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex w-full items-center justify-start px-4 py-2.5 text-red-300 hover:text-red-200 rounded-lg bg-red-500/20 hover:bg-red-500/30 group transition duration-150 ease-in-out">
                    <span class="material-symbols-outlined w-8">logout</span>
                    <span class="font-bold">Cerrar sesión</span>
                </button>
            </form>
        </div>
    </div>
</div>
