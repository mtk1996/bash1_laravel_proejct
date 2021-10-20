<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthApi extends Controller
{
    public function login(Request $request)
    {
        $e =  Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($e->fails()) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'data' => $e->errors(),
            ]);
        }

        $user = User::where('email', $request->email);

        if (!$user->first()) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'data' => 'email_not_found',
            ]);
        }

        $password_check = Hash::check($request->password, $user->first()->password);
        if (!$password_check) {
            return response()->json([
                'success' => false,
                'status' => 500,
                'data' => 'worng_password',
            ]);
        }

        $token = $user->first()->createToken('token')->accessToken;
        return response()->json([
            'success' => true,
            'status' => 200,
            'data' => [
                'token' => $token,
                'user' => $user->first(),
            ],
        ]);
    }
}




/*
    {
        success:ture,
        status:500,
        data:[]
    }
*/
