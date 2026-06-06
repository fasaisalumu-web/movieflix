<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        // Create 1 test user
        User::firstOrCreate(
            ['email' => 'testuser@movieflix.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );

        // Sample movies (using placeholder URLs for study)
        $movies = [
            ['title' => 'The Silent Horizon', 'genre' => 'Sci-Fi', 'year' => 2021, 'desc' => 'A crew explores a mysterious planet.'],
            ['title' => 'Echoes of Rain', 'genre' => 'Drama', 'year' => 2019, 'desc' => 'A family rebuilds after a natural disaster.'],
            ['title' => 'Neon Shadows', 'genre' => 'Thriller', 'year' => 2022, 'desc' => 'A detective hunts a cyber-criminal.'],
            ['title' => 'Golden Compass', 'genre' => 'Adventure', 'year' => 2020, 'desc' => 'A journey through uncharted territories.'],
            ['title' => 'Whispers in the Dark', 'genre' => 'Horror', 'year' => 2023, 'desc' => 'Strange sounds haunt an old mansion.'],
            ['title' => 'City of Lights', 'genre' => 'Romance', 'year' => 2018, 'desc' => 'Two strangers meet during a festival.'],
            ['title' => 'Iron Resolve', 'genre' => 'Action', 'year' => 2021, 'desc' => 'A retired soldier returns to duty.'],
            ['title' => 'The Last Canvas', 'genre' => 'Biography', 'year' => 2020, 'desc' => 'Life of a forgotten painter.'],
            ['title' => 'Starlight Drift', 'genre' => 'Sci-Fi', 'year' => 2022, 'desc' => 'Astronauts face a cosmic anomaly.'],
            ['title' => 'Beneath the Surface', 'genre' => 'Mystery', 'year' => 2019, 'desc' => 'A journalist uncovers a hidden truth.'],
            ['title' => 'Wildfire', 'genre' => 'Drama', 'year' => 2023, 'desc' => 'A community fights to save their forest.'],
            ['title' => 'Midnight Run', 'genre' => 'Comedy', 'year' => 2021, 'desc' => 'A chaotic road trip across three states.'],
        ];

        foreach ($movies as $m) {
            Movie::create([
                'title' => $m['title'],
                'description' => $m['desc'],
                'genre' => $m['genre'],
                'release_year' => $m['year'],
                'poster_url' => "https://placehold.co/300x450/1a1a2e/ffffff?text=" . urlencode($m['title']),
                'trailer_url' => "https://www.w3schools.com/html/mov_bbb.mp4", // Public sample video
                'download_url' => "https://www.w3schools.com/html/mov_bbb.mp4", // Public sample file
            ]);
        }
    }
}
