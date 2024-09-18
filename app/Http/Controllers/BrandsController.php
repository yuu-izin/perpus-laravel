<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Facilities;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
        public function index()
        {
            $facilities = Facilities::all();

            return view('pages.facilities.index', compact('facilities'));
        }

        public function create()
        {
            return view('pages.facilities.create');
        }

        public function store(Request $request)
        {
            $request->validate([
                'brand_name' => ['required'],
                'name'=>['required'],
                'quantity' =>['required'],
            ]);

            $brand = Brand::create([
                'name' => $request->brand_name,
            ]);

            $facilities = Facilities::create([
                'brand_id' => $brand->id,
                'name'=> $request->name,
                'quantity' => $request->quantity,
            ]);

            session()->flash('success', 'Facilities created successfully');
            return redirect()->route('facilities.index');
        }

        public function edit(Facilities $facilities)
        {
            return view('pages.facilities.edit', compact('facilities'));
        }

        public function update(Facilities $facilities, Request $request)
        {
            $request->validate([
                'brand_name' => ['required'],
                'name'=>['required'],
                'quantity' =>['required'],
            ]);

            $brand = Brand::create([
                'name' => $request->brand_name,
            ]);

            $facilities->update([
                'brand_id' => $brand->id,
                'name'=> $request->name,
                'quantity' => $request->quantity,
            ]);

            session()->flash('success', 'Facilities updated successfully');
            return redirect()->route('facilities.index');
        }

        public function destroy(Facilities $facilities)
        {
            $facilities->delete();

            session()->flash('success', 'Facilities deleted successfully');
            return redirect()->route('facilities.index');
        }
}
