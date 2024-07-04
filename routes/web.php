<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentLikeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', [HomePageController::class, 'index'])->name('home.index');
Route::get('/search', [HomePageController::class, 'search'])->name('home.search');
Route::get('/about', [HomePageController::class, 'about'])->name('home.about');
Route::get('/privacy-policy', [HomePageController::class, 'privacyPolicy'])->name('home.privacy-policy');
Route::get('/terms-and-conditions', [HomePageController::class, 'termsAndConditions'])->name('home.terms-and-conditions');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('auth.signup-form');
Route::post('/signup', [AuthController::class, 'signup'])->name('auth.signup-submit');

Route::get('/user/{user:username}', [UserController::class, 'show'])->name('user.show');
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('/update/{user:username}', [UserController::class, 'update'])->name('user.update');
Route::get('/settings', [UserController::class, 'settingsView'])->name('user.settings');
Route::post('/settings/update/info', [UserController::class, 'updateInfo'])->name('user.settings.update-info');
Route::post('/settings/update/password', [UserController::class, 'updatePassword'])->name('user.settings.update-password');
Route::post('/settings/update/image', [UserController::class, 'updateProfileImage'])->name('user.settings.update-image');
Route::post('/settings/update/banner', [UserController::class, 'updateProfileBanner'])->name('user.settings.update-banner');

Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
Route::get('/comment/{comment}', [CommentController::class, 'edit'])->name('comment.edit');
Route::put('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

Route::get('/comment/like/{comment}', [CommentLikeController::class, 'like'])->name('comment.like');


Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::get('/book/{book}', [BookController::class, 'show'])->name('book.show');
Route::get('/create', [BookController::class, 'create'])->name('book.create');
Route::post('/store', [BookController::class, 'store'])->name('book.store');
Route::get('/book/read/{book}', [BookController::class, 'read'])->name('book.read');
Route::get('/book/download/{book}', [BookController::class, 'download'])->name('book.download');
Route::get('/book/share/{book}', [BookController::class, 'share'])->name('book.share');
Route::get('/book/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
Route::put('/book/{book}/update', [BookController::class, 'update'])->name('book.update');
Route::delete('/book/{book}', [BookController::class, 'destroy'])->name('book.destroy');

Route::get('/genre/{genre}', [GenreController::class, 'show'])->name('genre.show');

Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
Route::put('/review', [ReviewController::class, 'update'])->name('review.update');
Route::delete('/review/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');

Route::get('/language/{language}', [LanguageController::class, 'show'])->name('language.show');
