<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class PermissionStoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a new permission.
     */
    public function testCreatePermission(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $newPermissionData = [
            'name' => 'New Permission',
        ];

        $response = $this->post('/api/permissions', $newPermissionData);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'id',
            'name',
        ]);

        $response->assertJson([
            'name' => $newPermissionData['name'],
        ]);

        $this->assertDatabaseHas('permissions', [
            'name' => $newPermissionData['name'],
        ]);
    }
}
