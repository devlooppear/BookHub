<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     *
     * @return Response
     */
    public function index()
    {
        $books = Book::all();

        return response()->json($books);
    }

    /**
     * Store a newly created book in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'isbn' => 'required|unique:books|string',
            'category' => 'required|string',
            'availability' => 'boolean',
        ]);

        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    /**
     * Display the specified book.
     *
     * @param  Book  $book
     * @return Response
     */
    public function show(Book $book)
    {
        return response()->json($book);
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
        $request->validate([
            'title' => 'string',
            'author' => 'string',
            'isbn' => 'unique:books|string',
            'category' => 'string',
            'availability' => 'boolean',
        ]);

        $book->update($request->all());

        return response()->json($book, 200);
    }

    /**
     * Remove the specified book from storage.
     *
     * @param  Book  $book
     * @return Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json(null, 204);
    }
}
