<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($data)) {
            return response()->error('Credentials not match', 401);
        }

        $user = User::where('email', $data['email'])->first();

        $token = $user->createToken('PLATFORM_USER')->plainTextToken;

        return response()->success([
            'token' => $token
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken('PLATFORM_USER')->plainTextToken;

        return response()->success([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->success("Successfully logged out");
    }

    public function user(Request $request)
    {
        return response()->success($request->user());
    }
}
