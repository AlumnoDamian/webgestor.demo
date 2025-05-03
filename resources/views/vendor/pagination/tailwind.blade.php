@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        {{-- Móvil --}}
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-300 cursor-not-allowed rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-white border border-gray-300 rounded-md hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                    {!! __('pagination.previous') !!}
                </button>
            @endif

            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-indigo-600 bg-white border border-gray-300 rounded-md hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                    {!! __('pagination.next') !!}
                </button>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-300 cursor-not-allowed rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        {{-- Desktop --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <span class="relative z-0 inline-flex shadow-sm">
                    {{-- Anterior --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-300 cursor-not-allowed rounded-l-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <button wire:click="previousPage" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-indigo-50 hover:text-indigo-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif

                    {{-- Páginas --}}
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-indigo-600 border border-indigo-600 cursor-default transition-colors duration-200">
                                            {{ $page }}
                                        </span>
                                    </span>
                                @else
                                    <button wire:click="gotoPage({{ $page }})" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-indigo-50 hover:text-indigo-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Siguiente --}}
                    @if ($paginator->hasMorePages())
                        <button wire:click="nextPage" rel="next" class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-indigo-50 hover:text-indigo-600 focus:z-10 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @else
                        <span aria-disabled="true">
                            <span class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-gray-400 bg-gray-50 border border-gray-300 cursor-not-allowed rounded-r-md">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
