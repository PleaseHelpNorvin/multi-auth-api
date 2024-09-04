<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function adminHome(Request $request)
    {
        try {
            // Check if the user is an admin
            if (!$request->user()->isAdmin()) {
                throw new HttpException(403, 'Forbidden');
            }

            return response()->json([
                'redirect_url' => url('/home/admin')
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
            ], $e->getStatusCode() ?? 403);
        }
    }

    public function userHome(Request $request)
    {
        try {
            // Check if the user is a regular user
            if (!$request->user()->isUser()) {
                throw new HttpException(403, 'Forbidden');
            }

            return response()->json([
                'redirect_url' => url('/home/user')
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong',
            ], $e->getStatusCode() ?? 403);
        }
    }

}
