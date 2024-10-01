<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();

        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required'],
        ]);

        $categories = categories::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        session()->flash('success', 'Categories created successfully');
        return redirect()->route('categories.index');
    }

    public function update(Request $request, Categories $categories)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required'],
        ]);

        $categories->update([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        session()->flash('success', 'Categories updated successfully');
        return redirect()->route('categories.index');
    }

    public function edit(Categories $categories)
    {
        return view('pages.categories.edit', compact('categories'));
    }

    public function destroy(Categories $categories)
    {
        $categories->delete();

        session()->flash('success', 'Categories deleted successfully');
        return redirect()->route('categories.index');
    }
}
