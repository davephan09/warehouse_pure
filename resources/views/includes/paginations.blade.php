@if ($paginator->hasPages())

<nav aria-label="...">
  <ul class=" pagination pagination-simple pagination-simple-line mb-0 ">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link" title="Previous"  href="javascript:void(0)">
                   Previous
                </a>
            </li>
        @else
            <li class="page-item ">
                <a class="page-link" title="Previous" data-href="{{ $paginator->previousPageUrl() }}">
                    Previous
                </a>
            </li>
        @endif


        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item page-item-num">
                    <a class="page-link" href="javascript:void(0)">{{ $element }}</a>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li  class="page-item page-item-num active" aria-current="page">
                            <a class="page-link" href="javascript:void(0)">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item page-item-num" >
                            <a class="page-link" data-href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" title="Next"  data-href="{{ $paginator->nextPageUrl() }}">
                    Next
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <a class="page-link" title="Next"  href="javascript:void(0)">
                    Next
                </a>
            </li>
        @endif
      </ul>
</nav>
@endif


