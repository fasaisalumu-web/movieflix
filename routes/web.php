<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ==========================================
// PUBLIC ROUTES (Guests & Logged-in Users)
// ==========================================

// Home page (Movie Catalog with Search & Filter)
Route::get('/', [MovieController::class, 'index'])->name('movies.index');

// Movie Details (Watch, Download, and View Rating)
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
// Public route for Top Rated movies
Route::get('/top-rated', [MovieController::class, 'topRated'])->name('movies.topRated');

// ==========================================
// PROTECTED ROUTES (Requires Login)
// ==========================================

// Submit Rating (AJAX)
Route::post('/movies/{movie}/rate', [RatingController::class, 'store'])
    ->middleware('auth')
    ->name('movies.rate');

// Dashboard (Default Breeze Route)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================
// ADMIN ROUTES (Protected by Admin Middleware)
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('movies', \App\Http\Controllers\Admin\MovieController::class);
});
// ==========================================
// BREEZE AUTHENTICATION ROUTES
// ==========================================
// This loads all login, register, logout, and password reset routes.
require __DIR__.'/auth.php';