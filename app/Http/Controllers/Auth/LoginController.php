<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends ApiController
{
    //
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password))
        {
            return $this->errorResponse('The provided credentials are incorrect.');
        }

        $token = $user->createToken($user->role)->plainTextToken;
        return $this->successResponse(['token'=>$token]);
    }
}
