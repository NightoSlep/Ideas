<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\FeedController;
use App\Http\Controllers\User\FollowerController;
use App\Http\Controllers\User\IdeaController;
use App\Http\Controllers\User\IdeaLikeController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class , 'index'])->name('dashboard');

Route::resource('ideas', IdeaController::class)->only('show');
        
Route::resource('ideas', IdeaController::class)->except('index', 'create', 'show')->middleware('auth');

Route::resource('ideas.comments', CommentController::class)->only('store')->middleware('auth');

Route::resource('users', UserController::class)->only('show');

Route::resource('users', UserController::class)->only('edit', 'update')->middleware('auth');

Route::get('profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('users/{user}/follow', [FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');
Route::post('users/{user}/unfollow', [FollowerController::class, 'unfollow'])->middleware('auth')->name('users.unfollow');

Route::post('ideas/{idea}/like', [IdeaLikeController::class, 'like'])->middleware('auth')->name('ideas.like');
Route::post('ideas/{idea}/unlike', [IdeaLikeController::class, 'unlike'])->middleware('auth')->name('ideas.unlike');

Route::get('/feed', FeedController::class)->middleware('auth')->name('feed');

Route::get('/terms', function(){
    return view('terms');
})->name('terms');

Route::middleware(['auth', 'can:admin'])->prefix('/admin')->as('admin.')->group(function() {
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('dashboard');
});