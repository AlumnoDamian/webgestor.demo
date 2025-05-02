<x-app-layout>
<div class="py-10">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 ml-16">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Comunicados</h2>
                    <button onclick="openModal()" type="button" class="group inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-800 via-indigo-800 to-indigo-900 
                                            border-0 rounded-lg font-semibold text-base text-white tracking-wide shadow-md
                                            hover:from-blue-700 hover:via-indigo-700 hover:to-indigo-800 
                                            focus:outline-none focus:ring-2 focus:ring-blue-500/50
                                            active:from-blue-800 active:via-indigo-800 active:to-indigo-900
                                            transition-all duration-200 ease-in-out
                                            min-w-[200px] transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        <span class="relative">
                            Nuevo comunicado
                            <span
                                class="absolute -bottom-0.5 left-0 w-full h-0.5 bg-white/30 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                        </span>
                    </button>
                </div>

                @include('memos._columns')
            </div>
        </div>

        @include('memos._modal')
        <script src="{{ asset('js/memos.js') }}"></script>
    </x-app-layout>