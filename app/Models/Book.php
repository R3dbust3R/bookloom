<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Language;
use App\Models\Genre;
use App\Models\Comment;

class Book extends Model
{
    use HasFactory;

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

    
}
