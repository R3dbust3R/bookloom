<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->text(350),
            'author' => fake()->name(),
            'language_id' => rand(1, 3),
            'genre_id' => rand(1, 5),
            'book_url' => '',
            'page_count' => rand(50, 350),
            'publisher' => rand(1, 10),
            'cover' => '',
            'views' => rand(10, 500),
            'downloaded_times' => rand(10, 500),
        ];
    }
}
