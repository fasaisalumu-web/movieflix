<x-app-layout>
    <x-slot name="header">
        <h2 class="mb-0">{{ $pageTitle ?? 'Discover Movies' }}</h2>
    </x-slot>

    <!-- Search and Filter Form -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card p-4">
                <form method="GET" action="{{ route('movies.index') }}" id="filterForm">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-7">
                            <label for="search" class="form-label">Search Movie</label>
                            <input type="text" name="search" id="search" class="form-control" 
                                   placeholder="Search by title or description..." 
                                   value="{{ request('search') }}" autocomplete="off">
                        </div>
                        <div class="col-md-5">
                            <label for="genre" class="form-label">Filter by Genre</label>
                            <select name="genre" id="genre" class="form-select">
                                <option value="">All Genres</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                                        {{ $genre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Movie Grid -->
    <div class="row g-4">
        @forelse($movies as $movie)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card movie-card h-100 overflow-hidden">
                    <a href="{{ route('movies.show', $movie->id) }}">
                        <img src="{{ $movie->poster_url }}" class="card-img-top movie-poster" alt="{{ $movie->title }}">
                    </a>
                    <div class="card-body d-flex flex-column p-3">
                        <h5 class="card-title movie-title mb-1">{{ $movie->title }}</h5>
                        <p class="text-muted small mb-3">
                            {{ $movie->genre }} • {{ $movie->release_year }}
                        </p>
                        
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="badge rating-badge">
                                ★ {{ number_format($movie->avg_rating, 1) }}
                            </span>
                            <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-primary btn-sm">
                                Watch
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="card p-5 bg-white">
                    <h4 class="text-muted mb-3">No movies found</h4>
                    <p class="text-muted">Try adjusting your search or filter criteria.</p>
                    <a href="{{ route('movies.index') }}" class="btn btn-outline-primary mt-2">Clear Filters</a>
                </div>
            </div>
        @endforelse
    </div>
</x-app-layout>