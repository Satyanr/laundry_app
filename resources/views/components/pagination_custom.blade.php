<div>
    @if ($paginator->lastPage() > 1)
        <ul class="pagination">
            @if ($paginator->currentPage() > 2)
                <li class="page-item"><a class="page-link" wire:click="gotoPage(1), '{{ $this->paginationName }}'">1</a></li>
                @if ($paginator->currentPage() > 3)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
            @endif

            @for ($i = max(1, $paginator->currentPage() - 1); $i <= min($paginator->lastPage(), $paginator->currentPage() + 2); $i++)
                <li class="page-item {{ $i == $paginator->currentPage() ? 'active' : '' }}">
                    <a href="javascript:void(0)" class="page-link" wire:click="gotoPage({{ $i }}, '{{ $this->paginationName }}')">{{ $i }}</a>
                </li>
            @endfor

            @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                <li class="page-item"><a class="page-link"
                        wire:click="gotoPage({{ $paginator->lastPage() }}, '{{ $this->paginationName }}')">{{ $paginator->lastPage() }}</a></li>
            @endif
        </ul>
    @endif
</div>
