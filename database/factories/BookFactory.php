<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'isbn' => $this->faker->unique()->isbn13,
            'category' => $this->faker->word,
            'availability' => $this->faker->boolean(80),
        ];
    }
}
