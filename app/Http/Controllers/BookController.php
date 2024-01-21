<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $books = Book::all();
            return response()->json($books);
        } catch (Exception $e) {
            Log::error('Error fetching books: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching books:' . $e->getMessage()]);
        }
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string',
                'author' => 'required|string',
                'isbn' => 'required|unique:books|string',
                'category' => 'required|string',
                'availability' => 'boolean',
            ]);

            $book = Book::create($request->all());

            return response()->json($book, 201);
        } catch (Exception $e) {
            Log::error('Error storing book: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while storing the book: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified book.
     *
     * @param  Book  $book
     * @return Response
     */
    public function show(Book $book)
    {
        try {
            return response()->json($book);
        } catch (Exception $e) {
            Log::error('Error fetching book details: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching book details: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified book in storage.
     *
     * @param  Request  $request
     * @param  Book  $book
     * @return Response
     */
    public function update(Request $request, Book $book)
    {
        try {
            $request->validate([
                'title' => 'string',
                'author' => 'string',
                'isbn' => 'unique:books|string',
                'category' => 'string',
                'availability' => 'boolean',
            ]);

            $book->update($request->all());

            return response()->json($book, 200);
        } catch (Exception $e) {
            Log::error('Error updating book: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the book: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  Book  $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            Log::error('Error deleting book: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the book: ' . $e->getMessage()]);
        }
    }
}
