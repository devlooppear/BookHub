<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Reservation;
use Carbon\Carbon;
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
            'reservation_date' => Carbon::now()->addDay(1)->format('Y-m-d H:i:s'),
            'pickup_deadline' => Carbon::now()->addDays(7)->format('Y-m-d H:i:s'),
            'is_active' => 1,
        ];

        $response = $this->post("/api/reservations/{$reservation->id}", $requestData);

        $response->assertStatus(200)
            ->assertJson([
                'book_id' => $requestData['book_id'],
                'reservation_date' => $requestData['reservation_date'],
                'pickup_deadline' => $requestData['pickup_deadline'],
                'is_active' => $requestData['is_active'],
            ]);
    }
}
