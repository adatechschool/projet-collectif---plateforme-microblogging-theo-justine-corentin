<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WallController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/explore', [ExploreController::class, 'show'])->middleware(['auth', 'verified'])->name('explore');

Route::get('/feed', [FeedController::class, 'index'])->middleware(['auth', 'verified'])->name('feed');
Route::patch('/feed', [FeedController::class, 'add'])->middleware(['auth', 'verified'])->name('feed.update');

Route::get('/wall', [WallController::class, 'show'])->middleware(['auth', 'verified'])->name('wall');

Route::resource('posts', PostController::class);

Route::get('/home', function () {
    return view('home');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::patch('/dashboard', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

require __DIR__.'/auth.php';
