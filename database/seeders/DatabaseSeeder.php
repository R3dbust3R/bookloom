<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Gender;
use App\Models\Language;
use App\Models\Genre;
use App\Models\Book;
use App\Models\Review;
use App\Models\Comment;
// use App\Models\Language;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $genders = ['male', 'female', 'unknown'];
        foreach ($genders as $gender) {
            Gender::factory()->create(['name' => $gender]); 
        }

        User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@admin',
            'password' => bcrypt('admin'),
            'gender_id' => 1,
            'bio' => 'Demo bio for admin',
            'website' => 'localhost/bookloom',
        ]);
        User::factory(10)->create();

        $languages = ['arabic', 'english', 'spanich'];
        foreach ($languages as $language) {
            Language::factory()->create(['name' => $language]);
        }

        $genres = ['default', 'fiction', 'action', 'horror', 'comedy'];
        foreach ($genres as $genre) {
            Genre::factory()->create(['name' => $genre]);
        }

        Book::factory(50)->create();
        Review::factory(350)->create();
        Comment::factory(100)->create();


    }
}
