<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use App\Models\Book;

class BookShowTest extends TestCase
{
    use RefreshDatabase;

    public function testShowBookById(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $book = Book::factory()->create();

        $response = $this->get("/api/books/{$book->id}");

        $response->assertStatus(200);

        $response->assertJson([
            'id' => $book->id,
            'title' => $book->title,
        ]);
    }

    /**
     * Test retrieving a book that does not exist.
     */
    public function testShowNonexistentBook(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $nonexistentBookId = 382764265463478;

        $response = $this->get("/api/books/{$nonexistentBookId}");

        $response->assertStatus(404);
    }
}
