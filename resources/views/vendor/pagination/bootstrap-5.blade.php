@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link rounded-circle bg-white border border-secondary text-muted px-3">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link rounded-circle bg-white border border-secondary text-dark px-3"
                       href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link rounded-circle bg-white border border-secondary text-muted px-3">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link rounded-circle bg-danger border-danger text-white px-3">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link rounded-circle bg-white border border-secondary text-dark px-3"
                                   href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link rounded-circle bg-white border border-secondary text-dark px-3"
                       href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link rounded-circle bg-white border border-secondary text-muted px-3">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
