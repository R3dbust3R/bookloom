<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Book;
use App\Models\CommentLike;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment', 'book_id', 'user_id', 'parent_id'
    ];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function likedBy() {
        return $this->belongsToMany(User::class, 'comment_likes', 'comment_id', 'user_id')->withTimestamps();
    }

    public function likedByUser() {
        return $this->likes()->where('user_id', Auth::id())->exists();
    }

    public function likes() {
        return $this->hasMany(CommentLike::class);
    }

    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent() {
        return $this->belongsTo(Comment::class, 'parent_id');
    }



}
