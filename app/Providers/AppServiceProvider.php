<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Review;
use App\Models\BookShare;
use App\Models\CommentLike;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * this is for bootstrap pagination
         */
        Paginator::useBootstrap();

        /**
         * This is for user book update athentication
         */
        Gate::define('update-book', function (User $user, Book $book) {
            return $user->id === $book->user_id;
        });

        /**
         * This is for comment update athentication
         */
        Gate::define('update-comment', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });

        /**
         * This is for review update athentication
         */
        Gate::define('update-review', function (User $user, Review $review) {
            return $user->id === $review->user_id;
        });

        /**
         * This is for sharing a book athentication
         */
        Gate::define('update-bookshare', function (User $user, BookShare $book_share) {
            return $user->id === $book_share->user_id;
        });

        /**
         * This is for liking a comment
         */
        Gate::define('update-commentlike', function (User $user, CommentLike $commentlike) {
            return $user->id === $commentlike->user_id;
        });

    }
}
