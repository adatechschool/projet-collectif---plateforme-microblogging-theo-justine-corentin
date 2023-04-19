<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WallController;
use App\Http\Livewire\WallUsers;
use App\Http\Livewire\PostListing;
use App\Http\Livewire\FeedListing;
use App\Http\Controllers\SearchController;
use GuzzleHttp\Middleware;
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

Route::get('/', PostListing::class)->middleware(['auth', 'verified'])->name('explore');

Route::get('/explore', PostListing::class)->middleware(['auth', 'verified'])->name('explore');

Route::get('/feed', FeedListing::class)->middleware(['auth', 'verified'])->name('feed');

Route::get('/search', [SearchController::class, 'search'])->name('search');
// WALL AUTRE USER
Route::get('/wall/{id}', WallUsers::class)->middleware(['auth', 'verified'])->name('wall.show');

// WALL PERSO CO
Route::get('/wall', [WallController::class, 'show'])->middleware(['auth', 'verified'])->name('wall');
// ROUTE TO DELETE POST FROM DB
Route::delete('/post/{id}', [WallController::class, 'destroy'])->middleware(['auth', 'verified'])->name('post.destroy');

// ROUTE ADD POST TO DB
Route::post('/post', [PostController::class, 'update'])->middleware(['auth', 'verified'])->name('post.update');

Route::get('/home', function () {
    return view('home');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::patch('/dashboard', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

require __DIR__.'/auth.php';
