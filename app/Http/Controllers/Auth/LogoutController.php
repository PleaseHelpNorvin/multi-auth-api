<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogoutController extends ApiController
{
    //
    public function logout(Request $request)
    {
        try {
            // Revoke all tokens for the authenticated user
            $user = Auth::user();
            $user->tokens()->delete();

            return $this->successResponse(null, 'Successfully logged out.');
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'Failed to log out. ' . $e->getMessage(), 500);
        }
    }

   
}
