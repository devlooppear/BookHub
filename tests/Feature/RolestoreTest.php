<?php

namespace Tests\Feature;

use App\Models\Role;
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

        $role = Role::factory()->create();

        $roleData = [
            'id' => $role->id +1,
            'name' => 'Example Role',
        ];

        $response = $this->post('/api/roles', $roleData);

        $response->assertSuccessful();

        $response->assertJson([
            'id' => $roleData['id'],
            'name' => $roleData['name'],
        ]);
    }
}
