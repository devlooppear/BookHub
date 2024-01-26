<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\Role;
use App\Models\User;

class RoleIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test for fetching the list of roles.
     */
    public function testIndexRoles(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        Role::factory()->count(3)->create();

        $response = $this->get("/api/roles");

        $response->assertStatus(200);

        $response->assertJsonCount(3, 'data');

    }
}
