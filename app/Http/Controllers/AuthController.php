<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        if ($req->isMethod("post")) {
            $req->validate([
                "email" => "required|email",
                "password" => "required|min:8",
            ]);

            $credentials = $req->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                if ($user->isAdmin) {
                    return redirect()->route('admin.dashboard')->with('success', 'Admin Login Successful');
                } else {
                    return redirect()->route('homepage')->with('success', 'User Login Successful');
                }
            }

            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        return view('login');
    }




    // register

    public function register()
    {

        return view('register');
    }

    public function registerUser(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the user
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'pincode' => $request->pincode,
        ]);

        return response()->json(['message' => 'User registered successfully!', 'redirect_url' => route('login')], 201);
    }

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out successfully.');
    }

}
