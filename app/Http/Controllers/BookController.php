<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCode;
use App\Models\Bookshelfs;
use App\Models\Categories;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['bookCode', 'category', 'bookshelf'])->get();
        return view('pages.book.index', compact('books'));
    }

    public function create()
{
    $categories = Categories::all();
    $bookshelfs = Bookshelfs::all();
    return view('pages.book.create', compact('categories', 'bookshelfs'));
}


public function store(Request $request)
{
    $request->validate([
        'code' => ['required'],
        'title' => ['required'],
        'description' => ['required'],
        'year' => ['required'],
        'publisher' => ['required'],
        'category_id' => ['required'],
        'book_shelf_id' => ['required'],
    ]);

    $category = Categories::find($request->category_id);
    $bookshelf = Bookshelfs::find($request->book_shelf_id);

    $code = BookCode::create([
        'code' => $request->code,
    ]);

    $book = Book::create([
        'book_code_id' => $code->id,
        'title' => $request->title,
        'description' => $request->description,
        'year' => $request->year,
        'publisher' => $request->publisher,
        'category_id' => $category->id,
        'book_shelf_id' => $bookshelf->id
    ]);

    session()->flash('success', 'Book created successfully');
    return redirect()->route('book.index');
}

    public function edit(Book $book)
    {
        $categories = Categories::all();
        $bookshelfs = Bookshelfs::all();
        return view('pages.book.edit', compact('book', 'categories', 'bookshelfs'));
    }

    public function update(Book $book, Request $request)
{
    $request->validate([
        'code' => ['required'],
        'title' => ['required'],
        'description' => ['required'],
        'year' => ['required'],
        'publisher' => ['required'],
        'category_id' => ['required'],
        'book_shelf_id' => ['required'],
    ]);

    $category = Categories::find($request->category_id);
    $bookshelf = Bookshelfs::find($request->book_shelf_id);

    $book->update([
        'title' => $request->title,
        'description' => $request->description,
        'year' => $request->year,
        'publisher' => $request->publisher,
        'category_id' => $category->id,
        'book_shelf_id' => $bookshelf->id
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
