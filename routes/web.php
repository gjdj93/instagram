<?php

use App\Http\Controllers\PostController;
use App\Mail\NewUserWelcomeMail;
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

Route::get('/{username}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
Route::get('/{username}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/{username}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

Route::get('/', [PostController::class, 'index']);
Route::resource('{username}/posts', PostController::class);

Route::post('{userid}/follow', [App\Http\Controllers\FollowController::class, 'store']);
