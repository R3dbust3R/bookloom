<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [HomePageController::class, 'index'])->name('home.index');
Route::get('/about', [HomePageController::class, 'about'])->name('home.about');

Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');

Route::get('/book/{book}', [BookController::class, 'show'])->name('book.show');
Route::get('/book/read/{book}', [BookController::class, 'read'])->name('book.read');
Route::get('/book/download/{book}', [BookController::class, 'download'])->name('book.download');

Route::get('/genre/{genre}', [GenreController::class, 'show'])->name('genre.show');

Route::get('/language/{language}', [LanguageController::class, 'show'])->name('language.show');
