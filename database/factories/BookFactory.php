<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends Factory<Book>
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
        $title = fake()->unique()->sentence(3);

        return [
            'category_id' => Category::factory(),
            'title' => $title,
            'slug' => fake()->unique()->slug(3),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 100, 2000),
            'published_at' => fake()->optional(0.8)->dateTimeBetween('-3 years', '+1 month'),
        ];
    }
}
