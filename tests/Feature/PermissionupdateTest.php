<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Permission;
use Laravel\Passport\Passport;

class PermissionUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test updating an existing permission.
     */
    public function testUpdatePermission(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $permission = Permission::factory()->create();

        $updatedPermissionData = [
            'name' => 'Updated Permission Name',
        ];

        $response = $this->post("/api/permissions/{$permission->id}", $updatedPermissionData);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'name',
        ]);

        $response->assertJson([
            'name' => $updatedPermissionData['name'],
        ]);

        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
            'name' => $updatedPermissionData['name'],
        ]);
    }
}
