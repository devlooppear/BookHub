<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use Laravel\Passport\Passport;

class BookDestroyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test destroying a book for an authenticated user.
     */
    public function testDestroyBookForAuthenticatedUser(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $book = Book::factory()->create();

        $response = $this->delete("/api/books/{$book->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    /**
     * Test destroying a book for an unauthenticated user.
     */
    public function testDestroyBookForUnauthenticatedUser(): void
    {
        $book = Book::factory()->create();

        $response = $this->delete("/api/books/{$book->id}");

        $response->assertStatus(401);

        $this->assertDatabaseHas('books', ['id' => $book->id]);
    }
}
