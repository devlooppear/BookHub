<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserstoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a new user.
     */
    public function testCreateUser(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password123',
        ];

        $response = $this->json('POST', '/api/users', $userData);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'User created successfully',
            ]);

        $response->assertJsonStructure([
            'message',
            'user' => [
                'id',
                'name',
                'email',
                'role_id',
            ],
        ]);
    }
}
