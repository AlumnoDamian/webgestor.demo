<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-0 shadow-sm p-2">
        @foreach($items as $item)
            <li class="breadcrumb-item @if($loop->last) active @endif">
                @if($loop->last)
                    {{ $item['title'] }}
                @else
                    <a href="{{ route($item['route']) }}" class="text-muted hover-text-primary transition-all duration-300">{{ $item['title'] }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
