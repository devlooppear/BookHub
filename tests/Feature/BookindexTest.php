<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use Laravel\Passport\Passport;

class BookIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test fetching books for an authenticated user.
     */
    public function testFetchBooksForAuthenticatedUser(): void
    {
       
        $user = User::factory()->create();
        Passport::actingAs($user);

        $books = Book::factory()->count(3)->create();

        $response = $this->get('/api/books');

        $response->assertStatus(200);

        foreach ($books as $book) {
            $response->assertJsonFragment([
                'title' => $book->title,
                'author' => $book->author,
            ]);
        }
    }

    /**
     * Test fetching books for an unauthenticated user.
     */
    public function testFetchBooksForUnauthenticatedUser(): void
    {

        $response = $this->get('/api/books');

        $response->assertStatus(401);
    }

}
