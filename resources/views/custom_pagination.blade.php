@if ($paginator->hasPages())
    <nav aria-label="Pagination" class="pagination">
        <ul class="pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li><a class="pagination-link" href="#" style="opacity: 0.5; pointer-events: none;">Trước</a></li>
            @else
                <li><a class="pagination-link" href="{{ $paginator->previousPageUrl() }}">Trước</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li><span class="pagination-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li><a aria-current="page" class="pagination-link active" href="#">{{ $page }}</a></li>
                        @else
                            <li><a class="pagination-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a class="pagination-link" href="{{ $paginator->nextPageUrl() }}">Sau</a></li>
            @else
                <li><a class="pagination-link" href="#" style="opacity: 0.5; pointer-events: none;">Sau</a></li>
            @endif
        </ul>
    </nav>
@endif
