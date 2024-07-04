<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Review;
use App\Models\CommentLike;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'gender_id',
        'birth_date',
        'bio',
        'profile_image',
        'profile_banner',
        'website',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function books() {
        return $this->hasMany(Book::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function likedComments() {
        return $this->belongsTo(Comment::class, 'comment_likes');
    }

    public function sharedBooks() {
        return $this->belongsToMany(Book::class, 'book_shares');
    }


}
