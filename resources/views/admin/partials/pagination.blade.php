@if ($paginator->total() > 0)
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $pageNumbers = [1, $currentPage - 1, $currentPage, $currentPage + 1, $lastPage];
        $visiblePages = [];

        foreach ($pageNumbers as $pageNumber) {
            if ($pageNumber < 1 || $pageNumber > $lastPage) {
                continue;
            }

            if (in_array($pageNumber, $visiblePages, true)) {
                continue;
            }

            $visiblePages[] = $pageNumber;
        }

        $previousVisiblePage = null;
    @endphp

    <div class="admin-pagination" aria-label="{{ $label ?? 'Pagination' }}">
        <p class="admin-pagination-summary">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </p>

        @if ($paginator->hasPages())
            <nav class="admin-pagination-links" aria-label="{{ $label ?? 'Pagination' }}">
                @if ($paginator->onFirstPage())
                    <span class="admin-pagination-link is-disabled" aria-disabled="true">Previous</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="admin-pagination-link" rel="prev">Previous</a>
                @endif

                @foreach ($visiblePages as $page)
                    @if ($previousVisiblePage !== null && $page - $previousVisiblePage > 1)
                        <span class="admin-pagination-ellipsis" aria-hidden="true">...</span>
                    @endif

                    @if ($page === $currentPage)
                        <span class="admin-pagination-link is-active" aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $paginator->url($page) }}" class="admin-pagination-link">{{ $page }}</a>
                    @endif

                    @php
                        $previousVisiblePage = $page;
                    @endphp
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="admin-pagination-link" rel="next">Next</a>
                @else
                    <span class="admin-pagination-link is-disabled" aria-disabled="true">Next</span>
                @endif
            </nav>
        @endif
    </div>
@endif
