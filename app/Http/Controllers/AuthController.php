<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'String|required',
            'last_name' => 'String|required',
            'email' => 'String|required|email|unique:users,email',
            'phone' => 'String|required|min:7|max:20|unique:users,phone',
            'password' => 'String|required|min:8|max:32|confirmed',
            'country' => 'String|required',
            // role will be set to 'customer' by default
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'message' => 'User account created successfully.',
            'data' => new UserResource($user),
        ], 201);
    }

    //
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'String|required|email',
            'password' => 'String|required|min:8|max:32',
        ]);
        // Check credentials
        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'The credentials are incorrect.',
            ], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'message' => 'Logged in successfully',
            'data' => new UserResource($user),
            'token' => $token,
            'token_type' => 'Bearer'
        ], 200);
    }

    //
    public function logout(Request $request)
    {
        // Delete all user's active tokens
        Auth::user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    //
}
