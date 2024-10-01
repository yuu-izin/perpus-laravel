<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use App\Models\UserProfiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('profile.position')->get();
        return view('pages.user.index', compact('users'));
    }


    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'nip' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'position_name' => ['required'],
        ]);

        $position = Position::firstOrCreate(['position_name' => $request->position_name]);

        $profile = UserProfiles::create([
            'nip' => $request->nip,
            'address' => $request->address,
            'phone' => $request->phone,
            'position_id' => $position->id,
        ]);

        $user = User::create([
            'profile_id' => $profile->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'position_id' => $position->id,  // Tambahkan baris ini
        ]);

        session()->flash('success', 'User created successfully');
        return redirect()->route('user.index');
    }


    public function edit(User $user)
    {
        $user->load('profile');
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        'password' => ['nullable', 'confirmed'],
        'nip' => ['required', 'string', 'max:50'],
        'address' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:15'],
        'position_name' => ['required', 'string', 'max:255'],
    ]);

    if ($user->profile) {
        $user->profile->update([
            'nip' => $request->nip,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
    } else {
        $user->profile()->create([
            'nip' => $request->nip,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
    }

    if ($request->filled('position_name')) {
        $position = Position::firstOrCreate([
            'position_name' => $request->position_name
        ]);
        $user->profile->update(['position_id' => $position->id]); // Update position di profile
    }

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password ? Hash::make($request->password) : $user->password,
    ]);

    session()->flash('success', 'User updated successfully');
    return redirect()->route('user.index');
}



    public function destroy(User $user)
    {
        if ($user->profile) {
            $user->profile->delete();
        }

        $user->delete();

        session()->flash('success', 'User deleted successfully');
        return redirect()->route('user.index');
    }
}
