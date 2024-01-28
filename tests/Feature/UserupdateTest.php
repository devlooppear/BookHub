<?php

namespace Tests\Feature;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserupdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test updating an existing user.
     */
    public function testUpdateUser(): void
    {

        $user = User::factory()->create();

        $role = Role::factory()->create();

        $updatedUserData = [
            'name' => 'Updated Name',
            'email' => 'updated.email@example.com',
            'password' => 'updatedpassword',
            'role_id' => $role->id,
        ];

        $response = $this->actingAs($user, 'api')
            ->json('POST', "/api/users/{$user->id}", $updatedUserData);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'User updated successfully',
            ]);


        $response->assertJsonStructure([
            'message',
            'user' => [
                'id',
                'name',
                'email',
                'role_id',
            ],
        ]);
    }
}
