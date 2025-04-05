<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token
            ]);
        }

        return response()->json([
            'message' => 'The provided credentials are incorrect.'
        ], 401);
    }

    public function logout(Request $request)
    {
        // Revoke all tokens...
        $request->user()->tokens()->delete();
        
        Auth::guard('web')->logout();
        
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}