<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        // 1. Validate input
        $request->validate([
            'score' => 'required|integer|min:1|max:5'
        ]);

        // 2. Create or Update rating (Enforces 1 rating per user per movie)
        $rating = Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'movie_id' => $movie->id
            ],
            [
                'score' => $request->score
            ]
        );

        // 3. Recalculate Movie Average and Count
        $avgRating = $movie->ratings()->avg('score');
        $ratingsCount = $movie->ratings()->count();

        $movie->update([
            'avg_rating' => $avgRating,
            'ratings_count' => $ratingsCount
        ]);

        // 4. Return JSON response for real-time update
        return response()->json([
            'success' => true,
            'avg_rating' => number_format($avgRating, 1),
            'ratings_count' => $ratingsCount,
            'user_score' => $rating->score
        ]);
    }
}