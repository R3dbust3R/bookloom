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


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('auth.signup-form')->middleware('guest');
Route::post('/signup', [AuthController::class, 'signup'])->name('auth.signup-submit')->middleware('guest');

Route::get('/', [HomePageController::class, 'index'])->name('home.index');
Route::get('/search', [HomePageController::class, 'search'])->name('home.search')->middleware(['auth', 'verified']);
Route::get('/about', [HomePageController::class, 'about'])->name('home.about');
Route::get('/privacy-policy', [HomePageController::class, 'privacyPolicy'])->name('home.privacy-policy');
Route::get('/terms-and-conditions', [HomePageController::class, 'termsAndConditions'])->name('home.terms-and-conditions');

Route::post('/toggle-dark-mode', [UserController::class, 'toggleDarkMode'])->name('user.toggle-dark-mode')->middleware('auth');

Route::get('/user/{user:username}', [UserController::class, 'show'])->name('user.show')->middleware('auth');
Route::get('/profile', [UserController::class, 'profile'])->name('user.profile')->middleware(['auth', 'verified']);
Route::get('/edit', [UserController::class, 'edit'])->name('user.edit')->middleware(['auth', 'verified']);
Route::post('/update/{user:username}', [UserController::class, 'update'])->name('user.update')->middleware(['auth', 'verified']);
Route::get('/settings', [UserController::class, 'settingsView'])->name('user.settings')->middleware('auth');
Route::post('/settings/update/info', [UserController::class, 'updateInfo'])->name('user.settings.update-info')->middleware('auth');
Route::post('/settings/update/password', [UserController::class, 'updatePassword'])->name('user.settings.update-password')->middleware('auth');
Route::post('/settings/update/image', [UserController::class, 'updateProfileImage'])->name('user.settings.update-image')->middleware('auth');
Route::post('/settings/update/banner', [UserController::class, 'updateProfileBanner'])->name('user.settings.update-banner')->middleware('auth');

Route::post('/comment', [CommentController::class, 'store'])->name('comment.store')->middleware(['auth', 'verified']);
Route::get('/comment/{comment}', [CommentController::class, 'edit'])->name('comment.edit')->middleware(['auth', 'verified']);
Route::put('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update')->middleware(['auth', 'verified']);
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy')->middleware(['auth', 'verified']);

Route::get('/comment/reply/{comment}', [CommentController::class, 'reply'])->name('comment.reply')->middleware(['auth', 'verified']);
Route::post('/comment/reply', [CommentController::class, 'replyStore'])->name('comment.reply-store')->middleware(['auth', 'verified']);

Route::get('/comment/like/{comment}', [CommentLikeController::class, 'like'])->name('comment.like')->middleware(['auth', 'verified']);


Route::get('/book', [BookController::class, 'index'])->name('book.index');
Route::get('/book/{book}', [BookController::class, 'show'])->name('book.show');
Route::get('/create', [BookController::class, 'create'])->name('book.create')->middleware(['auth', 'verified']);
Route::post('/store', [BookController::class, 'store'])->name('book.store')->middleware(['auth', 'verified']);
Route::get('/book/read/{book}', [BookController::class, 'read'])->name('book.read')->middleware(['auth', 'verified']);
Route::get('/book/download/{book}', [BookController::class, 'download'])->name('book.download')->middleware(['auth', 'verified']);
Route::get('/book/share/{book}', [BookController::class, 'share'])->name('book.share')->middleware(['auth', 'verified']);
Route::get('/book/{book}/edit', [BookController::class, 'edit'])->name('book.edit')->middleware(['auth', 'verified']);
Route::put('/book/{book}/update', [BookController::class, 'update'])->name('book.update')->middleware(['auth', 'verified']);
Route::delete('/book/{book}', [BookController::class, 'destroy'])->name('book.destroy')->middleware(['auth', 'verified']);

Route::get('/genre/{genre}', [GenreController::class, 'show'])->name('genre.show');

Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
Route::put('/review', [ReviewController::class, 'update'])->name('review.update')->middleware(['auth', 'verified']);
Route::delete('/review/{review}', [ReviewController::class, 'destroy'])->name('review.destroy')->middleware(['auth', 'verified']);

Route::get('/language/{language}', [LanguageController::class, 'show'])->name('language.show');


Route::get('/email/verify', [AuthController::class, 'verificationNotice'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verificationVerify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');