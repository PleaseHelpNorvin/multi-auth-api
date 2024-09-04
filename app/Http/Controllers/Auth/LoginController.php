<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends ApiController
{
    //
    public function login(Request $request)
    {
       
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);

        // $user = User::where('email', $request->email)->first();
        // if(!$user || !Hash::check($request->password, $user->password))
        // {
        //     return $this->errorResponse('The provided credentials are incorrect.');
        // }

        // $token = $user->createToken($user->role)->plainTextToken;
        // return $this->successResponse(['token'=>$token]);

         // Validate incoming request
         $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Generate a token for the user
            $token = $user->createToken('Personal Access Token')->plainTextToken;

            // Determine role and respond accordingly
            if ($user->isAdmin()) {
                return response()->json([
                    'message' => 'Admin logged in successfully',
                    'token' => $token,
                    'role' => 'admin',
                    'redirect' => '/home/admin'
                ], 200);
            }

            if ($user->isUser()) {
                return response()->json([
                    'message' => 'User logged in successfully',
                    'token' => $token,
                    'role' => 'user',
                    'redirect' => '/home/user'
                ], 200);
            }

            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }

        // Return error if authentication fails
        return response()->json([
            'message' => 'Invalid credentials',
        ], 401);
    }
}
