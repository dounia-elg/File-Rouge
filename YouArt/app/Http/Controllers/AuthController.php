<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function showRegister()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:artist,art_lover',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('register')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);


        Auth::login($user);


        if ($user->role === 'artist') {
            return redirect()->route('artist.space');
        } else {
            return redirect()->route('home');
        }
    }


    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();


            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->role === 'artist') {
                return redirect()->route('artist.space');
            } else if (Auth::user()->role === 'art_lover') {
                return redirect()->route('artlover.space');
            } else {
                return redirect()->route('home');
            }
        }


        return back()
            ->withErrors(['email' => 'The provided credentials do not match our records.'])
            ->withInput($request->except('password'));
    }

    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
