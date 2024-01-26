<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Reservation;
use Laravel\Passport\Passport;

class ReservationUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test updating an existing reservation.
     */
    public function testUpdateReservation(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $book = Book::factory()->create();
        $reservation = Reservation::factory()->create();

        $requestData = [
            'book_id' => $book->id,
            'reservation_date' => now(),
            'pickup_deadline' => now()->addDays(7),
            'is_active' => true,
        ];

        $response = $this->post("/api/reservations/{$reservation->id}", $requestData);

        $response->assertStatus(200);

        $response->assertJson([
            'user_id' => $requestData['user_id'],
            'book_id' => $requestData['book_id'],
            'reservation_date' => $requestData['reservation_date'],
            'pickup_deadline' => $requestData['pickup_deadline'],
            'is_active' => $requestData['is_active'],
        ]);

    }

    /**
     * Test updating a non-existent reservation.
     */
    public function testUpdateNonexistentReservation(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $nonexistentReservationId = 382764265463478;
        $requestData = [
            'reservation_date' => now(),
            'pickup_deadline' => now()->addDays(7),
            'is_active' => true,
        ];

        $response = $this->post("/api/reservations/{$nonexistentReservationId}", $requestData);

        $response->assertStatus(404);

    }
}
