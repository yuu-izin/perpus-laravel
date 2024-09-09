<?php

namespace App\Http\Controllers;

use App\Models\Visits;
use Illuminate\Http\Request;

class VisitsController extends Controller
{
    public function index()
    {
        $visits = Visits::all();
        return view('pages.visits.index', compact('visits'));
    }

    public function create()
    {
        return view('pages.visits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'phone' => ['required'],
            'agency' => ['required'],
        ]);

        Visits::create([
            'name' => $request->name,
            'date' => $request->date,
            'phone' => $request->phone,
            'agency' => $request->agency,
        ]);

        session()->flash('success', 'Visits created successfully');
        return redirect()->route('visits.index');
    }

    public function update(Request $request, Visits $visits)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required'],
            'phone' => ['required'],
            'agency' => ['required'],
        ]);

        $visits->update([
            'name' => $request->name,
            'date' => $request->date,
            'phone' => $request->phone,
            'agency' => $request->agency,
        ]);

        session()->flash('success', 'Visits updated successfully');
        return redirect()->route('visits.index');
    }

    public function edit(Visits $visits)
    {
        return view('pages.visits.edit', compact('visits'));
    }

    public function destroy(Visits $visits)
    {
        $visits->delete();

        session()->flash('success', 'Visits deleted successfully');
        return redirect()->route('visits.index');
    }
}
