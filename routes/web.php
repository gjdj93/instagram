<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostLikeController;
use Illuminate\Support\Facades\Route;

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


Auth::routes(['verify' => true]);

Route::get('/email/verify', function() {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/{username}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/{username}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/{username}', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/', [PostController::class, 'index']);
Route::get('posts/{post}', [PostController::class, 'show']);
Route::resource('{username}/posts', PostController::class);

Route::post('{userid}/follow', [FollowController::class, 'store']);

Route::post('posts/{post}/like', [PostLikeController::class, 'store']);

Route::get('{username}/likes', [PostLikeController::class, 'showUsersLikes']);
Route::get('posts/{post}/likes', [PostLikeController::class, 'showPostLikes']);
