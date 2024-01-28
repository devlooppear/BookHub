<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Passport\Passport;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

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

        $response = $this->get("/api/roles");

        $response->assertOk();
    }
}
