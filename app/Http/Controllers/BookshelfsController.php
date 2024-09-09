<?php

namespace App\Http\Controllers;

use App\Models\Bookshelfs;
use Illuminate\Http\Request;

class BookshelfsController extends Controller
{
    public function index()
    {
        $bookshelfs = Bookshelfs::all();

        return view('pages.bookshelfs.index', compact('bookshelfs'));
    }

    public function create()
    {
        return view('pages.bookshelfs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'name' => ['required'],
        ]);

        $categories = Bookshelfs::create([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        session()->flash('success', 'Bookshelfs created successfully');
        return redirect()->route('bookshelfs.index');
    }

    public function edit(Bookshelfs $bookshelfs)
    {
        return view('pages.bookshelfs.edit', compact('bookshelfs'));
    }

    public function update(Bookshelfs $bookshelfs, Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'name' => ['required'],
        ]);

        $bookshelfs->update([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        session()->flash('success', 'Bookshelfs updated successfully');
        return redirect()->route('bookshelfs.index');
    }

    public function destroy(Bookshelfs $bookshelfs)
    {
        $bookshelfs->delete();

        session()->flash('success', 'Bookshelfs deleted successfully');
        return redirect()->route('bookshelfs .index');
    }
}
