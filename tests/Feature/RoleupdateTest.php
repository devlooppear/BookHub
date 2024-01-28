<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\Passport;

class RoleUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test for updating a role.
     */
    public function testUpdateRole(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $role = Role::factory()->create();

        $updatedRoleData = [
            'name' => 'Updated Role Name',
        ];

        $response = $this->post("/api/roles/{$role->id}", $updatedRoleData);

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $role->id,
            'name' => $updatedRoleData['name'],
        ]);
    }
}
