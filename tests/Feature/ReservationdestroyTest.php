<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Reservation;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\YourUserModel;

class ReservationDestroyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test deleting a reservation.
     */
    public function testDeleteReservation(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $reservation = Reservation::factory()->create();

        $response = $this->delete("/api/reservations/{$reservation->id}");

        $response->assertStatus(204);

    }

    /**
     * Test deleting a non-existent reservation.
     */
    public function testDeleteNonexistentReservation(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $nonexistentReservationId = 999999;

        $response = $this->delete("/api/reservations/{$nonexistentReservationId}");

        $response->assertStatus(404);

    }
}
