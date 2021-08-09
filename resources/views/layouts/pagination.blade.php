@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
        <li><a><i class="ti-arrow-left"></i></a></li>
    @else
        <li><a href="{{ $paginator->previousPageUrl() }}"><i class="ti-arrow-left"></i></i></a></li>
    @endif
@endif

@if (is_array($elements[0]))
    @foreach ($elements[0] as $page => $url)
        @if ($page == $paginator->currentPage())
            <li><a href="{{ $url }}" class="active">{{ $page }}</a></li>
        @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
    @endforeach
@endif

@if ($paginator->hasMorePages())
    <li><a href="{{ $paginator->nextPageUrl() }}"><i class="ti-arrow-right"></i></a></li>
@else
    <li><a><i class="ti-arrow-right"></i></a></li>
@endif
