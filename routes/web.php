<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;
use \App\Http\Controllers\ModeratorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/feed', [FeedController::class, 'feed'])->middleware(['auth']);
Route::post('/addtoit', [FeedController::class, 'addtoit'])->middleware(['auth']);
Route::get('/profile/{username}', [FeedController::class, 'profile'])->middleware(['auth']);
Route::get('/follow/{id}', [FeedController::class, 'follow'])->middleware(['auth']);
Route::get('/unfollow/{id}', [FeedController::class, 'unfollow'])->middleware(['auth']);

Route::middleware(['auth', 'roles:moderator'])->group(function () {
    Route::get('/moderate/reported', [ModeratorController::class, 'viewReported']);
    Route::get('/moderate/accept/report/{toit_id}', [ModeratorController::class, 'acceptReport']);
    Route::get('/moderate/reject/report/{toit_id}', [ModeratorController::class, 'rejectReport']);
});

require __DIR__.'/auth.php';
