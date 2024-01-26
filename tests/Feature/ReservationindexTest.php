<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Reservation;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\YourUserModel;

class ReservationIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fetching a list of reservations.
     */
    public function testFetchReservations(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $reservations = Reservation::factory(3)->create();

        $response = $this->get('/api/reservations');

        $response->assertStatus(200);

        $response->assertJsonCount(count($reservations), 'data');

    }

    /**
     * Test fetching reservations with authentication failure.
     */
    public function testFetchReservationsWithoutAuthentication(): void
    {
        $response = $this->get('/api/reservations');

        $response->assertStatus(401);

    }
}
