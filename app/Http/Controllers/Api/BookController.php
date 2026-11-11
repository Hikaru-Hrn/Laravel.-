<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with(['category', 'authors'])
            ->when($request->filled('search'), fn ($query) => $query->search($request->input('search')))
            ->when($request->boolean('published'), fn ($query) => $query->published())
            ->latest()
            ->get();

        return BookResource::collection($books);
    }

    public function store(Request $request)
    {
        $book = Book::create($this->validated($request));
        $book->authors()->sync($request->input('authors', []));

        return (new BookResource($book->load(['category', 'authors'])))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Book $book)
    {
        $book->load(['category', 'authors', 'reviews']);

        return new BookResource($book);
    }

    public function update(Request $request, Book $book)
    {
        $book->update($this->validated($request, $book));
        $book->authors()->sync($request->input('authors', []));

        return new BookResource($book->load(['category', 'authors', 'reviews']));
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->noContent();
    }

    private function validated(Request $request, ?Book $book = null): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('books', 'slug')->ignore($book?->id),
            ],
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'published_at' => 'nullable|date',
            'authors' => 'nullable|array',
            'authors.*' => 'exists:authors,id',
        ]);
    }
}
