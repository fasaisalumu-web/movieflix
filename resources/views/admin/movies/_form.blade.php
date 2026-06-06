<div class="row g-4">
    <div class="col-md-6">
        <label for="title" class="form-label">Movie Title</label>
        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
               value="{{ old('title', $movie->title ?? '') }}" required>
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" name="genre" id="genre" class="form-control @error('genre') is-invalid @enderror" 
               value="{{ old('genre', $movie->genre ?? '') }}" required>
        @error('genre') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $movie->description ?? '') }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="release_year" class="form-label">Release Year</label>
        <input type="number" name="release_year" id="release_year" class="form-control @error('release_year') is-invalid @enderror" 
               value="{{ old('release_year', $movie->release_year ?? '') }}" min="1900" max="{{ date('Y') + 1 }}" required>
        @error('release_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="poster_url" class="form-label">Poster URL (Image)</label>
        <input type="url" name="poster_url" id="poster_url" class="form-control @error('poster_url') is-invalid @enderror" 
               value="{{ old('poster_url', $movie->poster_url ?? '') }}" placeholder="https://...">
        @error('poster_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label for="trailer_url" class="form-label">Trailer URL (Video)</label>
        <input type="url" name="trailer_url" id="trailer_url" class="form-control @error('trailer_url') is-invalid @enderror" 
               value="{{ old('trailer_url', $movie->trailer_url ?? '') }}" placeholder="https://...">
        @error('trailer_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label for="download_url" class="form-label">Download URL</label>
        <input type="url" name="download_url" id="download_url" class="form-control @error('download_url') is-invalid @enderror" 
               value="{{ old('download_url', $movie->download_url ?? '') }}" placeholder="https://...">
        @error('download_url') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 pt-3 border-top mt-3">
        <button type="submit" class="btn btn-primary px-4">
            {{ isset($movie) ? 'Update Movie' : 'Create Movie' }}
        </button>
        <a href="{{ route('admin.movies.index') }}" class="btn btn-light ms-2">Cancel</a>
    </div>
</div>