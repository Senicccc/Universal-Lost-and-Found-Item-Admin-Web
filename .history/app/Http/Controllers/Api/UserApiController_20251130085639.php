<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserApiController extends ApiController
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => bin2hex(random_bytes(30)),
        ]);

        return response()->json(['user' => $user, 'api_token' => $user->api_token], 201);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return $this->jsonError('Invalid credentials', 401);
        }

        $user->api_token = bin2hex(random_bytes(30));
        $user->save();

        return response()->json(['user' => $user, 'api_token' => $user->api_token]);
    }

    public function index()
    {
        $users = User::select('id','name','email')->get();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = User::select('id','name','email')->find($id);
        if (!$user) return response()->json(['error' => 'Not found'], 404);
        return response()->json($user);
    }
}
