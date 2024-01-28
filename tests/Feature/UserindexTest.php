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
        User::factory()->create();

        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->getJson('/api/users');

        $response->assertSuccessful();
    }
}
