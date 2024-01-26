<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class UserIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test for fetching a list of users.
     */
    public function testFetchListOfUsers(): void
    {
        // Creating some dummy users for testing
        User::factory()->count(5)->create();

        // Creating a dummy user for testing authentication
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }
}
