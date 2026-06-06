<x-app-layout>
    <x-slot name="header">
        <h2 class="mb-0">{{ $movie->title }}</h2>
    </x-slot>

    <div class="row g-4">
        <!-- Video Player -->
        <div class="col-lg-8">
            <div class="card overflow-hidden">
                <div class="ratio ratio-16x9 bg-dark">
                    <video id="movie-player" controls class="w-100 h-100">
                        <source src="{{ $movie->trailer_url }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>

        <!-- Movie Details -->
        <div class="col-lg-4">
            <div class="card p-4 h-100">
                <img src="{{ $movie->poster_url }}" class="img-fluid rounded mb-4 shadow-sm" alt="{{ $movie->title }}">
                
                <div class="d-flex align-items-center mb-3">
                    <span class="badge rating-badge fs-6 me-2">★ {{ number_format($movie->avg_rating, 1) }}</span>
                    <small class="text-muted">({{ $movie->ratings_count }} ratings)</small>
                </div>

                <div class="mb-3">
                    <span class="badge bg-light text-dark border me-1">{{ $movie->genre }}</span>
                    <span class="badge bg-light text-dark border">{{ $movie->release_year }}</span>
                </div>

                <p class="text-muted mt-3" style="line-height: 1.6;">{{ $movie->description }}</p>

                <div class="d-grid gap-2 mt-4">
                    <a href="{{ $movie->download_url }}" class="btn btn-primary" download>
                        Download Movie
                    </a>
                </div>

                <!-- Rating Section -->
                <div id="rating-section" class="mt-4 pt-4 border-top">
                    <h6 class="fw-bold mb-3">Rate this Movie</h6>
                    
                    @auth
                        <p class="text-muted small mb-2">Click on a star to rate:</p>
                        <div class="star-rating-container" data-movie-id="{{ $movie->id }}">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="star {{ $userRating && $i <= $userRating->score ? 'active' : '' }}" 
                                      data-value="{{ $i }}">★</span>
                            @endfor
                        </div>
                        <p class="mt-2 small text-success" id="rating-message"></p>
                    @else
                        <p class="text-muted small mb-0">
                            Please <a href="{{ route('login') }}" class="text-primary fw-bold">login</a> to rate this movie.
                        </p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>