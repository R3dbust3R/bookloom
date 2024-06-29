<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Language;
use App\Models\Genre;
use App\Models\Comment;
use App\Models\Review;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'author', 
        'language_id', 
        'genre_id',
        'user_id',
        'page_count', 
        'book_url', 
        'cover', 
        'views'
    ];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function language() {
        return $this->belongsTo(Language::class);
    }

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    
}
