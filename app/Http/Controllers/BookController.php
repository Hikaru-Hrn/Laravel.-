<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['category', 'authors'])->latest()->get();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create', [
            'book' => new Book,
            'categories' => Category::orderBy('name')->get(),
            'authors' => Author::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $book = Book::create($this->validated($request));
        $book->authors()->sync($request->input('authors', []));

        return redirect()->route('books.show', $book)->with('success', 'Книга создана.');
    }

    public function show(Book $book)
    {
        $book->load(['category', 'authors', 'reviews']);

        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', [
            'book' => $book,
            'categories' => Category::orderBy('name')->get(),
            'authors' => Author::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $book->update($this->validated($request, $book));
        $book->authors()->sync($request->input('authors', []));

        return redirect()->route('books.show', $book)->with('success', 'Книга обновлена.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Книга удалена.');
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
