<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use Laravel\Passport\Passport;

class ReservationStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test storing a new reservation.
     */
    public function testStoreReservation(): void
    {
        // Create a specific user for testing
        $user = User::factory()->create([
            'name' => 'MeTestedHere',
            'email' => 'testing@example.com',
        ]);

        Passport::actingAs($user);

        $book = Book::factory()->create();

        $requestData = [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'reservation_date' => '2024-01-26T23:54:04.000000Z',
            'pickup_deadline' => '2024-02-02T23:54:04.000000Z', // Adjusted for a realistic deadline
            'is_active' => 1,
        ];

        $response = $this->post('/api/reservations', $requestData);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'id',
            'user_id',
            'book_id',
            'reservation_date',
            'pickup_deadline',
            'is_active',
            'created_at',
            'updated_at',
        ]);

        $response->assertJson([
            'user_id' => $requestData['user_id'],
            'book_id' => $requestData['book_id'],
            'reservation_date' => $requestData['reservation_date'],
            'pickup_deadline' => $requestData['pickup_deadline'],
            'is_active' => $requestData['is_active'],
        ]);
    }

    /**
     * Test storing a new reservation without authentication.
     */
    public function testStoreReservationWithoutAuthentication(): void
    {
        $book = Book::factory()->create();

        $requestData = [
            'book_id' => $book->id,
            'reservation_date' => now(),
            'pickup_deadline' => now()->addDays(7),
            'is_active' => 1,
        ];

        $response = $this->post('/api/reservations', $requestData);

        $response->assertStatus(401);
    }
}
