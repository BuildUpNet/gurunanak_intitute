{{-- Gallery pagination: ‹ Prev · 1 2 3 … 9 · Next › + "Page X of Y" --}}
@if ($paginator->hasPages())
    <nav class="gpg" role="navigation" aria-label="Gallery pages">
        <div class="gpg__bar">
            @if ($paginator->onFirstPage())
                <span class="gpg__arrow is-disabled" aria-disabled="true">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i><span class="gpg__arrow-text">Prev</span>
                </span>
            @else
                <a class="gpg__arrow" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous page">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i><span class="gpg__arrow-text">Prev</span>
                </a>
            @endif

            <ul class="gpg__pages">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <li><span class="gpg__dots" aria-hidden="true">…</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li>
                                @if ($page == $paginator->currentPage())
                                    <span class="gpg__num is-active" aria-current="page">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</span>
                                @else
                                    <a class="gpg__num" href="{{ $url }}" aria-label="Page {{ $page }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach
            </ul>

            @if ($paginator->hasMorePages())
                <a class="gpg__arrow" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next page">
                    <span class="gpg__arrow-text">Next</span><i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            @else
                <span class="gpg__arrow is-disabled" aria-disabled="true">
                    <span class="gpg__arrow-text">Next</span><i class="fas fa-arrow-right" aria-hidden="true"></i>
                </span>
            @endif
        </div>

        <p class="gpg__info">Page <b>{{ $paginator->currentPage() }}</b> of <b>{{ $paginator->lastPage() }}</b></p>
    </nav>
@endif
