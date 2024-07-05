<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gender;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSignupForm() {
        $genders = Gender::all();
        return view('auth.signup-form', compact('genders'));
    }

    public function signup(Request $request) {

        $validated = $request->validate([
            'name'              => ['required', 'string', 'min:3', 'max:255'],
            'username'          => ['required', 'string', 'min:3', 'max:255', 'unique:users,username'],
            'email'             => ['required', 'email', 'min:3', 'max:255', 'unique:users,email'],
            'password'          => ['required', 'string', 'min:5', 'confirmed'],
            'gender_id'         => ['required', 'exists:genders,id'],
            'birth_date'        => ['required', 'date', 'before:2020-01-01', 'after:1920-01-01'],
            'bio'               => ['nullable', 'string', 'min:5', 'max:5000'],
            'profile_image'     => ['nullable', 'image', 'mimes:jpeg,jpg,png,avif,webp', 'max:5120'],
            'profile_banner'    => ['nullable', 'image', 'mimes:jpeg,jpg,png,avif,webp', 'max:5120'],
            'website'           => ['nullable', 'url', 'max:255'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('profile_image')) {
            $profile_image = $request->file('profile_image')->store('users', 'public');
            $validated['profile_image'] = $profile_image;
        }

        if ($request->hasFile('profile_banner')) {
            $profile_banner = $request->file('profile_banner')->store('users/banners', 'public');
            $validated['profile_banner'] = $profile_banner;
        }

        $user = User::create($validated);

        if ($user->save()) {
            return redirect()->route('login.form')->with('success', 'Account has been created successfuly!');
        }
        
        return redirect()->back()->with('error', 'There was an error while trying to create your account, try again later!');
        
    }

    public function showLoginForm() {
        return view('auth.login-form');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $remember = $request->input('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('user.profile');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    public function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('login.form');
    }
}
