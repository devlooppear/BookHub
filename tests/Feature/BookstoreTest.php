<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;

class BookstoreTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a new book.
     */
    public function testStoreBook(): void
    {
        $user = User::factory()->create();

        Passport::actingAs($user);

        $bookData = [
            'title' => 'Sample Book',
            'author' => 'Sample Author',
            'category' => 'Sample Category',
        ];

        $response = $this->post('/api/books', $bookData);

        $response->assertStatus(201);

        $response->assertJson([
            'title' => $bookData['title'],
            'author' => $bookData['author'],
            'category' => $bookData['category'],
            'availability' => $bookData['availability'],
        ]);

        $this->assertDatabaseHas('books', [
            'title' => $bookData['title'],
        ]);
    }

    /**
     * Test creating a new book with invalid data.
     */
    public function testStoreBookWithInvalidData(): void
    {
        $user = User::factory()->create();

        Passport::actingAs($user);

        $invalidBookData = [
        ];

        $response = $this->post('/api/books', $invalidBookData);

        $response->assertStatus(422);
    }
}
