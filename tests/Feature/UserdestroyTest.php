<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserdestroyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test deleting an existing user.
     */
    public function testDestroyUser(): void
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')
            ->json('DELETE', "/api/users/{$user->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'User deleted successfully',
            ]);
    }
}
