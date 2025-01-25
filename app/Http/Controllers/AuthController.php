<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use CommonTrait;

    public function login(Request $request)
    {
       $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
 
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError(['message' => 'Authentication Error'], 401);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse(['data'=> $user, 'token' => $token, 'message' => 'Logged In successfully']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->sendResponse(['data' => $user, 'token' => $token, 'message' => 'User created successfully'], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return $this->sendResponse(['message' => 'Logged Out successfully']);
    }
}
