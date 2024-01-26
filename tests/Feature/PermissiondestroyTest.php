<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\Permission;

class PermissionDestroyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test destroying a permission.
     */
    public function testDestroyPermission(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $permission = Permission::factory()->create();

        $response = $this->delete("/api/permissions/{$permission->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('permissions', ['id' => $permission->id]);
    }

    /**
     * Test destroying a nonexistent permission.
     */
    public function testDestroyNonexistentPermission(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $nonexistentPermissionId = 382764265463478;

        $response = $this->delete("/api/permissions/{$nonexistentPermissionId}");

        $response->assertStatus(404);
    }
}
