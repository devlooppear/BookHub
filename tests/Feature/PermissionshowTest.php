<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\Permission;

class PermissionShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test retrieving details of a specific permission.
     */
    public function testShowPermission(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $permission = Permission::factory()->create();

        $response = $this->get("/api/permissions/{$permission->id}");

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'id',
            'name',
        ]);

        $response->assertJson([
            'id' => $permission->id,
            'name' => $permission->name,
        ]);
    }

    /**
     * Test retrieving details of a nonexistent permission.
     */
    public function testShowNonexistentPermission(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $nonexistentPermissionId = 382764265463478;

        $response = $this->get("/api/permissions/{$nonexistentPermissionId}");

        $response->assertStatus(404);
    }
}
