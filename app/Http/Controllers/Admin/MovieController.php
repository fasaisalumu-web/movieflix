<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // 1. List all movies
    public function index()
    {
        $movies = Movie::latest()->get();
        return view('admin.movies.index', compact('movies'));
    }

    // 2. Show form to create a new movie
    public function create()
    {
        return view('admin.movies.create');
    }

    // 3. Save the new movie to database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:100',
            'release_year' => 'required|integer|digits:4|min:1900|max:' . (date('Y') + 1),
            'poster_url' => 'nullable|url',
            'trailer_url' => 'nullable|url',
            'download_url' => 'nullable|url',
        ]);

        // Set default placeholders if URLs are empty
        $validated['poster_url'] = $validated['poster_url'] ?? 'https://placehold.co/300x450/1a1a2e/ffffff?text=No+Poster';
        $validated['trailer_url'] = $validated['trailer_url'] ?? 'https://www.w3schools.com/html/mov_bbb.mp4';
        $validated['download_url'] = $validated['download_url'] ?? 'https://www.w3schools.com/html/mov_bbb.mp4';

        Movie::create($validated);

        return redirect()->route('admin.movies.index')->with('success', 'Movie created successfully!');
    }

    // 4. Show form to edit an existing movie
    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    // 5. Update the movie in database
    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:100',
            'release_year' => 'required|integer|digits:4|min:1900|max:' . (date('Y') + 1),
            'poster_url' => 'nullable|url',
            'trailer_url' => 'nullable|url',
            'download_url' => 'nullable|url',
        ]);

        // Set default placeholders if URLs are empty
        $validated['poster_url'] = $validated['poster_url'] ?? 'https://placehold.co/300x450/1a1a2e/ffffff?text=No+Poster';
        $validated['trailer_url'] = $validated['trailer_url'] ?? 'https://www.w3schools.com/html/mov_bbb.mp4';
        $validated['download_url'] = $validated['download_url'] ?? 'https://www.w3schools.com/html/mov_bbb.mp4';

        $movie->update($validated);

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully!');
    }

    // 6. Delete the movie
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted successfully!');
    }
}