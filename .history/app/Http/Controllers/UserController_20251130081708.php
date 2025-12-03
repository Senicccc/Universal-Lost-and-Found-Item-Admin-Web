<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        Log::create([
            'user_id' => $user->id,
            'action' => 'Created user "' . $user->name . '"',
        ]);

        return redirect()->route('users.index')->with('success', 'User created.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        Log::create([
            'user_id' => $user->id,
            'action' => 'Updated user "' . $user->name . '"',
        ]);

        return redirect()->route('users.index')->with('success', 'User updated.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        Log::create([
            'user_id' => $user->id,
            'action' => 'Deleted user "' . $user->name . '"',
        ]);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }
}