<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function postLogin()
    {
        //check email
        $user  = User::where('email', request()->email)->first();
        if (!$user) {
            return redirect()->back()->with('danger', 'Email NOt Found In Our Record');
        }
        //password
        $cre =  ['email' => request()->email, 'password' => request()->password];
        if (Auth::attempt($cre)) {
            //successs
            return redirect('/admin');
        } else {
            return redirect()->back()->with('danger', 'Wrong Password');
        }
    }
}
