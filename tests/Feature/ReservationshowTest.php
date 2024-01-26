<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Reservation;
use Laravel\Passport\Passport;
use App\Models\User;

class ReservationShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test showing a specific reservation.
     */
    public function testShowReservation(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $reservation = Reservation::factory()->create();

        $response = $this->get("/api/reservations/{$reservation->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $reservation->id,
            'user_id' => $reservation->user_id,
        ]);

    }

    /**
     * Test showing a nonexistent reservation.
     */
    public function testShowNonexistentReservation(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $nonexistentReservationId = 382764265463478;
        $response = $this->get("/api/reservations/{$nonexistentReservationId}");

        $response->assertStatus(404);

    }

    /**
     * Test showing a reservation without authentication.
     */
    public function testShowReservationWithoutAuthentication(): void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->get("/api/reservations/{$reservation->id}");

        $response->assertStatus(401);

    }
}
