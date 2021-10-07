<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        if (auth()->check()) {
            return redirect('/')->with('error', 'You Already Reigster!');
        }
        return view('auth.register');
    }
    public function register()
    {
        //validation

        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
        ]);
        Auth::login($user);
        return redirect('/')->with('success', 'Welcome ' . $user->name);
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login()
    {
        $cre =  request()->only('email', 'password');
        if (Auth::attempt($cre)) {
            return redirect('/')->with('success', 'Welcome ' . auth()->user()->name);
        }
        return redirect()->back()->with('error', 'Email And Password Dont Match!');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Loggout Successfully!');
    }
}
