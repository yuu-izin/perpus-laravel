<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();

        return view('pages.member.index', compact('members'));
    }

    public function create()
    {
        return view('pages.member.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Member::class],
            'phone' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
        ]);

        $member = Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        session()->flash('success', 'Member created successfully');
        return redirect()->route('member.index');
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Member::class],
            'phone' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
        ]);

        $member->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
        ]);

        session()->flash('success', 'Member updated successfully');
        return redirect()->route('member.index');
    }

    public function edit(Member $member)
    {
        return view('pages.member.edit', compact('member'));
    }

    public function destroy(Member $member)
    {
        $member->delete();

        session()->flash('success', 'Member deleted successfully');
        return redirect()->route('member.index');
    }
}
