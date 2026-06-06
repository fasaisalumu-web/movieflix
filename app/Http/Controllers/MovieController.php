<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        // Start a query
        $query = Movie::query();

        // 1. Search Logic (Title or Description)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // 2. Genre Filter Logic
        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        // Get movies and distinct genres for the dropdown
        $movies = $query->latest()->get();
        $genres = Movie::distinct()->pluck('genre')->sort()->values();

        return view('movies.index', compact('movies', 'genres'));
    }
    public function topRated(Request $request)
    {
        $query = Movie::query();

        // Allow filtering by search and genre even on the Top Rated page
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        // Sort by highest rating first. 
        // If ratings are equal, sort by the highest number of ratings (ratings_count)
        $movies = $query->orderByDesc('avg_rating')
                        ->orderByDesc('ratings_count')
                        ->get();

        $genres = Movie::distinct()->pluck('genre')->sort()->values();
        $pageTitle = 'Top Rated Movies';

        return view('movies.index', compact('movies', 'genres', 'pageTitle'));
    }

    public function show(Movie $movie)
    {
        // Get user's rating if logged in
        $userRating = auth()->check() ? $movie->userRating(auth()->id()) : null;
    
        return view('movies.show', compact('movie', 'userRating'));
    }
}