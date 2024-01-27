<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\Permission;

class PermissionIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test retrieving a list of permissions.
     */
    public function testIndexPermissions(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        Permission::factory()->count(3)->create();

        $response = $this->get("/api/permissions");

        $response->assertStatus(200);

        $data = $response->json();

        $this->assertCount(3, $data);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
            ],
        ]);
    }
}
