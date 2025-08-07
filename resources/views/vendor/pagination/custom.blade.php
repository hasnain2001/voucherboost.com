
    <ul class="pagination justify-content-center custom-pagination">
        <!-- Previous Button -->
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a>
            </li>
        @endif

        <!-- Pagination Elements -->
        @foreach ($elements as $element)
            <!-- Dots -->
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            <!-- Page Numbers -->
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- Next Button -->
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        @endif
    </ul>

@push('scripts')
    <style>
        .custom-pagination .page-link {
            color: #fff;
            background-color: #701e7d; /* Purple */
            border-color: #6f42c1;
            transition: all 0.3s ease-in-out;
            padding: 10px 15px;
            font-size: 16px;
        }

        .custom-pagination .page-link:hover {
            background-color: #8a2be2; /* Darker Purple */
            border-color: #4b2a89;
        }

        .custom-pagination .active .page-link {
            color: black;
            background-color: white; /* Highlighted Purple */
            border-color: #5a189a;
        }

        .custom-pagination .page-item.disabled .page-link {
            color: #bbb;
            background-color: #f8f9fa;
            border-color: #ddd;
        }

        .custom-pagination .page-item {
            margin: 0 5px; /* Add spacing between buttons */
        }

        /* Media Queries for Mobile Responsiveness */
        @media (max-width: 768px) {
            .custom-pagination .page-link {
                font-size: 14px; /* Smaller font for mobile */
                padding: 8px 10px; /* Reduced padding for smaller buttons */
            }

            .custom-pagination {
                flex-wrap: wrap; /* Allow wrapping for better fit on small screens */
            }

            .custom-pagination .page-item {
                margin: 2px; /* Reduce spacing between buttons */
            }
        }
    </style>
@endpush
