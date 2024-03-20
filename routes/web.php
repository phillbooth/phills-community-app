<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;



use Inertia\Inertia;
use App\Models\Article;
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $articles = Article::latest()->get(); // Fetch all articles, ordered by creation date
        return Inertia::render('Dashboard', [
            'articles' => $articles // Pass articles to the Vue component
        ]);
    })->name('dashboard');

    Route::resource('articles', ArticleController::class);
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show')->middleware('auth');
    Route::get('/articles-create', function () {
        return Inertia::render('Articles'); // Make sure 'Articles' corresponds to your Vue component name
    })->name('articles-create');
    Route::post('articles/store', [ArticleController::class, 'store'])->name('articles-store');

    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/articles/{article}/comments', [CommentController::class, 'index'])->name('comments.index');

    Route::post('/comments/{article}', [CommentController::class, 'store'])->name('comments.store2');

    Route::post('/comments/{parentId}/replies', [CommentController::class, 'storeReply'])->name('comments.storeReply');
    
});
    




require __DIR__.'/auth.php';
