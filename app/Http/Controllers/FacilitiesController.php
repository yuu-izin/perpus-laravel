<?php

namespace App\Http\Controllers;

use App\Models\Facilities; // Pastikan nama model sesuai konvensi PascalCase
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    public function index()
    {
        $facilities = Facilities::all(); // Gunakan nama variabel yang benar

        return view('pages.facilities.index', compact('facilities')); // Perbaiki compact
    }

    public function create()
    {
        return view('pages.facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string', 'max:255'],
        ]);

        $facilities = Facilities::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
        ]);

        session()->flash('success', 'Facilities created successfully');
        return redirect()->route('facilities.index');
    }

    public function update(Request $request, Facilities $facilities) 
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'string', 'max:255'],
        ]);

        $facilities->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
        ]);

        session()->flash('success', 'Facilities updated successfully');
        return redirect()->route('facilities.index');
    }

    public function edit(Facilities $facilities)
    {
        return view('pages.facilities.edit', compact('facilities'));
    }

    public function destroy(Facilities $facilities)
    {
        $facilities->delete();

        session()->flash('success', 'Facilities deleted successfully');
        return redirect()->route('facilities.index');
    }
}
