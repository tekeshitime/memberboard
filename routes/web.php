<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TrackController;
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

Route::get('/threads', [ThreadController::class, 'index'])->name('threads');

Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
Route::post('/threads/create', [ThreadController::class, 'store']);

Route::post('/threads/{thread}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::resource('tracks', TrackController::class)->names([
    'index' => 'tracks.index',
    'create' => 'tracks.create',
    'store' => 'tracks.store',
    'show' => 'tracks.show',
    'edit' => 'tracks.edit',
    'update' => 'tracks.update',
    'destroy' => 'tracks.destroy',
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
