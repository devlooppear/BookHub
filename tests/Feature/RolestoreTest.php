<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\Passport;

class RoleStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test for storing a role.
     */
    public function testStoreRole(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $roleData = [
            'name' => 'Example Role',
        ];

        $response = $this->post('/api/roles', $roleData);

        $response->assertStatus(201);

        $response->assertJson([
            'id' => $roleData['id'],
            'name' => $roleData['name'],
        ]);
    }

    /**
     * Test storing a role with validation errors.
     */
    public function testStoreRoleWithValidationErrors(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $invalidRoleData = [
        ];

        $response = $this->post('/api/roles', $invalidRoleData);

        $response->assertStatus(422);

    }
}
