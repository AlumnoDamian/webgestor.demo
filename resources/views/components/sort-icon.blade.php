@if ($sortField === $field)
    @if ($sortDirection === 'asc')
        <svg class="ml-2 h-4 w-4 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L10 13.586l3.293-3.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    @else
        <svg class="ml-2 h-4 w-4 text-indigo-600" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L10 6.414l-3.293 3.293a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
    @endif
@else
    <svg class="ml-2 h-4 w-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity duration-200" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L10 13.586l3.293-3.293a1 1 0 011.414 0z" clip-rule="evenodd" />
    </svg>
@endif
