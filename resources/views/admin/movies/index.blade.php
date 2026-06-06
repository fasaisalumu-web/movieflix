<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Manage Movies</h2>
            <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">
                + Add New Movie
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Year</th>
                        <th>Rating</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movies as $movie)
                        <tr>
                            <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
                            <td class="fw-medium">{{ $movie->title }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $movie->genre }}</span></td>
                            <td class="text-muted">{{ $movie->release_year }}</td>
                            <td>
                                <span class="badge rating-badge">★ {{ number_format($movie->avg_rating, 1) }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                    Edit
                                </a>
                                <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">No movies found. Add your first movie!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>