@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col sm:flex-row items-center justify-between gap-4 py-4">
        
        <!-- Results Counter Text -->
        <div>
            <p class="text-xs text-slate-500 font-medium">
                Showing
                @if ($paginator->firstItem())
                    <span class="font-bold text-slate-900">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="font-bold text-slate-900">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                of
                <span class="font-bold text-slate-900">{{ $paginator->total() }}</span>
                results
            </p>
        </div>

        <!-- Pagination Controls -->
        <div>
            <ul class="inline-flex items-center gap-1.5 p-1 rounded-2xl bg-white border border-slate-200/80 shadow-xs list-none m-0">
                
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li>
                        <span aria-disabled="true" aria-label="Previous" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-300 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </span>
                    </li>
                @else
                    <li>
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/70 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li>
                            <span aria-disabled="true" class="inline-flex items-center justify-center w-9 h-9 text-xs font-semibold text-slate-400">
                                {{ $element }}
                            </span>
                        </li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <li>
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-xs font-black bg-indigo-600 text-white shadow-md shadow-indigo-600/30">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-xs font-semibold text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/70 transition">
                                        {{ $page }}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li>
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/70 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </li>
                @else
                    <li>
                        <span aria-disabled="true" aria-label="Next" class="inline-flex items-center justify-center w-9 h-9 rounded-xl text-slate-300 cursor-not-allowed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </li>
                @endif

            </ul>
        </div>

    </nav>
@endif
