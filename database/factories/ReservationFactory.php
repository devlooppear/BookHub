<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create();

        return [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'reservation_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'pickup_deadline' => $this->faker->dateTimeBetween('+1 day', '+2 weeks'),
            'is_active' => $this->faker->boolean(80),
        ];
    }
}
