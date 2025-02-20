@if ($paginator->hasPages())
    <nav class="flex justify-center mt-4 space-x-2">
        {{-- Previous Button --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 bg-gray-300 text-gray-500 rounded cursor-not-allowed">Prev</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Prev</a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
            @if ($page == $paginator->currentPage())
                <span class="px-3 py-1 bg-blue-600 text-white rounded">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next Button --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Next</a>
        @else
            <span class="px-3 py-1 bg-gray-300 text-gray-500 rounded cursor-not-allowed">Next</span>
        @endif
    </nav>
@endif
