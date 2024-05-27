<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(){
        return view('auth.register');
    }

    public function store(){
        $validate = request()->validate(
            [
            'name' => 'required|min:3|max:40',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            ]
        );

        User::create(
            [
                'name' => $validate['name'],
                'email' => $validate['email'],
                'password' => Hash::make($validate['password']),
            ]
        );

        return redirect()->route('dashboard')->with('success', "Account created successfully!");
    }

    public function login(){
        return view('auth.login');
    }

    public function authenticate(){


        $validated = request()->validate(
            [
                'email' => 'required|email',
                'password' => 'required|max:20',
            ]
        );

        if(auth()->attempt($validated)){
            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success', "Login successfully!");
        }

        return redirect()->route('login')->withErrors([
            'email' => "No matching with the provided email and password!"
        ]);
    }

    public function logout(){
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success', "Logout successfully");
    }
}
