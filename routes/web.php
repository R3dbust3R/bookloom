<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [HomePageController::class, 'index'])->name('home.index');
Route::get('/search', [HomePageController::class, 'search'])->name('home.search');
Route::get('/about', [HomePageController::class, 'about'])->name('home.about');
Route::get('/privacy-policy', [HomePageController::class, 'privacyPolicy'])->name('home.privacy-policy');
Route::get('/terms-and-conditions', [HomePageController::class, 'termsAndConditions'])->name('home.terms-and-conditions');

Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');

Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::get('/book/{book}', [BookController::class, 'show'])->name('book.show');
Route::get('/book/read/{book}', [BookController::class, 'read'])->name('book.read');
Route::get('/book/download/{book}', [BookController::class, 'download'])->name('book.download');

Route::get('/genre/{genre}', [GenreController::class, 'show'])->name('genre.show');

Route::get('/review', [ReviewController::class, 'index'])->name('review.index');

Route::get('/language/{language}', [LanguageController::class, 'show'])->name('language.show');
