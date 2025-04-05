<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $response = Http::post(url('/api/register'), [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'role' => $request->role,
        ]);

        if ($response->successful()) {
            return redirect('/dashboard')
                ->with('success', 'Registration successful!');
        }

        return back()
            ->withErrors($response->json()['errors'])
            ->withInput();
    }
}