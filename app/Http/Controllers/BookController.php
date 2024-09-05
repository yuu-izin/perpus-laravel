<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('pages.book.index', compact('books'));
    }

    public function create()
    {
        return view('pages.book.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'year' => ['required'],
            'publisher' => ['required'],
        ]);

        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'year' => $request->year,
            'publisher' => $request->publisher,
        ]);

        session()->flash('success', 'Book created successfully');
        return redirect()->route('book.index');
    }

    public function edit(Book $book)
    {
        return view('pages.book.edit', compact('book'));
    }

    public function update(Book $book, Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'year' => ['required'],
            'publisher' => ['required'],
        ]);

        $book->update([
            'title' => $request->title,
            'description' => $request->description,
            'year' => $request->year,
            'publisher' => $request->publisher,
        ]);

        session()->flash('success', 'Book updated successfully');
        return redirect()->route('book.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        session()->flash('success', 'Book deleted successfully');
        return redirect()->route('book.index');
    }
}
