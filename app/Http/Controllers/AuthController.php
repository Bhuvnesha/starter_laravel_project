<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Landing Page
    public function landing()
    {
        return view('landing');
    }

    // Show Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register Logic
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/dashboard');
    }

    // Show Login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login Logic
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // Dashboard
    public function dashboard()
    {
        return view('dashboard');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}