@if ($paginator->hasPages() || $paginator->currentPage() == 1)
    <div class="flex justify-end space-x-2 mt-5">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="rounded-full bg-white border border-slate-300 py-2 px-3 text-slate-300 cursor-not-allowed">
                <i class="fa-solid fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                class="rounded-full bg-white border border-slate-300 py-2 px-3 text-slate-600 hover:text-white hover:bg-emerald-700 hover:border-emerald-700 focus:ring-2 focus:ring-emerald-500">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span
                    class="rounded-full bg-white border border-slate-300 py-2 px-3 text-slate-500 cursor-default">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span
                            class="min-w-9 rounded-full bg-emerald-700 border border-emerald-700 py-2 px-3.5 text-white cursor-default">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="min-w-9 rounded-full bg-white border border-slate-300 py-2 px-3.5 text-slate-600 hover:text-white hover:bg-emerald-600 hover:border-emerald-700 focus:ring-2 focus:ring-emerald-500">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                class="rounded-full bg-white border border-slate-300 py-2 px-3 text-slate-600 hover:text-white hover:bg-emerald-700 hover:border-emerald-700 focus:ring-2 focus:ring-emerald-500">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        @else
            <span class="rounded-full bg-white border border-slate-300 py-2 px-3 text-slate-300 cursor-not-allowed">
                <i class="fa-solid fa-chevron-right"></i>
            </span>
        @endif
    </div>
@endif