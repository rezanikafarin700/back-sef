<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        auth()->attempt([
            'mobile' => $request->username,
            'password' => $request->password
       ]);

        if(auth()->check()){
            return response(['token' =>auth()->user()->generateToken()],200);
        }
        return response([
            'error' => 'اطلاعات کاربری اشتباه است'
        ],401);
    }
}
