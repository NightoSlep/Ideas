<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class , 'index'])->name('dashboard');

Route::group(['prefix' => 'ideas/', 'as' => 'ideas.'], function(){

    Route::post('/ideas', [IdeaController::class , 'store'])->name('store');

    Route::get('/ideas/{idea}', [IdeaController::class , 'show'])->name('show');

    Route::group(['middleware' => ['auth']], function(){
    
        Route::get('/ideas/{idea}/edit', [IdeaController::class , 'edit'])->name('edit');
        
        Route::put('/ideas/{idea}', [IdeaController::class , 'update'])->name('update');
        
        Route::delete('/ideas/{idea}', [IdeaController::class , 'destroy'])->name('destroy');
        
        Route::post('/ideas/{idea}/comments', [CommentController::class , 'store'])->name('comments.store');
    });
});

Route::get('/terms', function(){
    return view('terms');
});