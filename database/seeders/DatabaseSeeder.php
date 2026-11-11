<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categories = Category::factory(4)->create();
        $authors = Author::factory(6)->create();
        $books = Book::factory(10)->recycle($categories)->create();

        $books->each(function (Book $book) use ($authors) {
            $book->authors()->attach($authors->random(rand(1, 2))->modelKeys());
            $book->reviews()->create(Review::factory()->raw());
        });

        $authors->each(function (Author $author) {
            $author->reviews()->create(Review::factory()->raw());
        });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
