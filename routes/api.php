<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FactController;
use App\Http\Controllers\API\BookmarkController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\QuizController;

Route::group(['prefix' => 'v1'], function () {

    // login route
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');
    Route::post('/register', [AuthController::class, 'register'])->name('api.register');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('api.forgot-password');


    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('api.dashboard.index');

    Route::get(
        '/facts',
        [FactController::class, 'index']
    )->name('api.facts.index');
    Route::get('/facts/{fact}', [FactController::class, 'show'])->name('api.facts.show');

    Route::get('/categories', [CategoryController::class, 'index'])->name('api.categories.index');
    Route::get('/categories/all', [CategoryController::class, 'all'])->name('api.categories.all');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('api.categories.show');

    Route::get('/daily-fact', [FactController::class, 'dailyFact'])->name('api.daily-fact');
    Route::get('/trending-facts', [FactController::class, 'trendingFacts'])->name('api.trending-facts');
    Route::get('/new-facts', [FactController::class, 'newFacts'])->name('api.new-facts');

    Route::get('/quizzes', [QuizController::class, 'index'])->name('api.quizzes.index');
    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('api.quizzes.show');

    Route::get('/generateQuizQuestions', [QuizController::class, 'generateQuizQuestions'])->name('api.generateQuizQuestions');
    Route::get('/generateQuiz', [QuizController::class, 'generateQuiz'])->name('api.generateQuiz');


    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/user', function (Request $request) {
            $user = $request->user();
            $user->profile_image_url = $user->gravatar;
            return $user;
        });

        // Route::get('/facts/{fact}/vote-status', [FactController::class, 'votes-status'])->name('api.facts.vote-status');

        Route::post('/facts/{fact}/upvote', [FactController::class, 'upvote'])->name('api.facts.upvote');
        Route::post('/facts/{fact}/downvote', [FactController::class, 'downvote'])->name('api.facts.downvote');
        Route::post('/facts/{fact}/unvote', [FactController::class, 'unvote'])->name('api.facts.unvote');
        Route::post('/facts/{fact}/toggle-vote', [FactController::class, 'toggleVote'])->name('api.facts.toggle-vote');

        Route::post('/facts/{fact}/bookmark', [FactController::class, 'toggleBookmark'])->name('api.facts.bookmark');

        Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('api.bookmarks.index');


        // quiz routes


        Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');
    });
});