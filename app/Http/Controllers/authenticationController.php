<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class authenticationController extends Controller
{
    public function registerUser(Request $request) {
        try {
            // Validate incoming request
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'fingerprint' => 'required',
            ]);

            // Create new user
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'fingerprint' => $validatedData['fingerprint'],
            ]);

            // Redirect user to the login page
            return redirect('/')->with('success', 'User registered successfully');
        } catch (\Throwable $th) {
            // Return error response
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function loginUser(Request $reuest){
        try{

        } catch (\Throwable $th) {
            // Return error response
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
