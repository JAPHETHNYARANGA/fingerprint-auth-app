<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function loginUser(Request $request){
        try{
            // Check if the request contains fingerprint data
            if ($request->filled('fingerprint')) {
                // Find the user by their fingerprint
                $user = User::where('fingerprint', $request->input('fingerprint'))->first();

                if ($user) {
                    // Log in the user
                    Auth::login($user);
                    return redirect('/home')->with('success', 'User logged in successfully');
                } else {
                    return redirect('/')->with('error', 'Fingerprint not recognized');
                }
            } else {
                // Attempt to log in with email and password
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    return redirect('/home')->with('success', 'User logged in successfully');
                } else {
                    return redirect('/')->with('error', 'Invalid email or password');
                }
            }
        } catch (\Throwable $th) {
            // Return error response
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
