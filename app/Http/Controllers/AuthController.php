<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('backend.signin');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $credentials['username'])->get()->first();
        if (!$user || $user->role != 1) {
            return back()->with('signin_error', 'Only admin can access this system');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        }

        return back()->with('signin_error', 'Login Failed');
    }

    public function signout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/auth');
    }

    public function signup(Request $request)
    {
        return view('backend.signup');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|min:10|max:100|unique:users|email:dns',
            'username' => 'required|min:3|max:100|unique:users',
            'password' => 'required|min:6|max:100|'
        ]);

        // encrypt password to hash
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return redirect('/auth')->with('success', 'Registration successful. Please login to continue');
    }

    public function authenticateApi(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken(env('APP_KEY'))->plainTextToken;

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Sign in succeess',
                    'data' => $user,
                    'token' => $token,
                ],
                200
            );
        }

        return response()->json(
            [
                'success' => false,
                'message' => 'Credentials not valid',
            ],
            401
        );
    }

    public function signupApi(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|min:10|max:100|unique:users|email:dns',
            'username' => 'required|min:3|max:100|unique:users',
            'password' => 'required|min:6|max:100|'
        ]);

        // encrypt password to hash
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        return response()->json(
            [
                'success' => true,
                'message' => 'Sign up succeess',
            ],
            201
        );
    }
}
