<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TweetLikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\TweetSaveController;
use App\Http\Controllers\UserSavedTweetsController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/tweets/search', [TweetController::class, 'search'])->name('tweets.search');
    Route::resource('tweets', TweetController::class);
    Route::post('/tweets/{tweet}/like', [TweetLikeController::class, 'store'])->name('tweets.like');
    Route::delete('/tweets/{tweet}/like', [TweetLikeController::class, 'destroy'])->name('tweets.dislike');
    Route::post('/follow/{user}', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{user}', [FollowController::class, 'destroy'])->name('follow.destroy');
    Route::resource('tweets.comments', CommentController::class);
    Route::post('/tweets/{tweet}/save', [TweetSaveController::class, 'store'])->name('tweets.save');
    Route::delete('/tweets/{tweet}/save', [TweetSaveController::class, 'destroy'])->name('tweets.unsave');
    Route::get('/saved-tweets', [UserSavedTweetsController::class, 'index'])->middleware('auth')->name('saved.tweets');
});

require __DIR__.'/auth.php';
