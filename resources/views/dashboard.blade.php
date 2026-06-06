<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="text-center mb-4">
                    <h1 class="display-5 fw-bold text-dark">Welcome back, {{ Auth::user()->name }}! 🎬</h1>
                    <p class="text-muted lead">Ready to watch some new movies today?</p>
                </div>

                <div class="row mt-5">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border-primary shadow-sm">
                            <div class="card-body text-center p-5">
                                <h3 class="card-title text-primary">Browse Movies</h3>
                                <p class="card-text text-muted">Explore our catalog of movies, watch trailers, and find the ones you love.</p>
                                <a href="{{ route('movies.index') }}" class="btn btn-primary btn-lg mt-3">Go to Catalog</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card h-100 border-success shadow-sm">
                            <div class="card-body text-center p-5">
                                <h3 class="card-title text-success">Your Ratings</h3>
                                <p class="card-text text-muted">View the movies you've rated and see the average rating for each.</p>
                                <a href="{{ route('movies.index') }}" class="btn btn-success btn-lg mt-3">View Ratings</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>