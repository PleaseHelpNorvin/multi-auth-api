<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function adminHome(Request $request)
    {
        // Check if the user is an admin
        if (!$request->user()->isAdmin()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json([
            'redirect_url' => url('/home/admin')
        ], 200);
    }

    public function userHome(Request $request)
    {
        // Check if the user is a regular user
        if (!$request->user()->isUser()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json([
            'redirect_url' => url('/home/user')
        ], 200);
    }
}
