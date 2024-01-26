<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\Role;
use App\Models\User;

class RoleShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test for showing a role by ID.
     */
    public function testShowRoleById(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $role = Role::factory()->create();

        $response = $this->get("/api/roles/{$role->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $role->id,
            'name' => $role->name,
        ]);
    }

    /**
     * Test retrieving a role that does not exist.
     */
    public function testShowNonexistentRole(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $nonexistentRoleId = 382764265463478;

        $response = $this->get("/api/roles/{$nonexistentRoleId}");

        $response->assertStatus(404);
    }
}
