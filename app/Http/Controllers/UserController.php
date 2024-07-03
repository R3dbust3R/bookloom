<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function profile() {
        // $books = Book::with()
        //         ->latest()
        //         ->paginate(1);
        $books = Book::where('user_id', Auth::id())
                ->with(['user', 'language', 'genre', 'comments', 'reviews'])
                ->orderBy('id', 'desc')
                ->paginate(12);
        return view('user.profile', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $books = Book::where('user_id', $user->id)
                ->with(['user', 'genre', 'language'])
                ->OrderBy('id', 'desc')
                ->paginate(12);
        return view('user.show', compact('user', 'books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $genders = Gender::all();
        $user = Auth::user();
        return view('user.edit', compact('genders', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name'              => ['required', 'string', 'min:3', 'max:255'],
            'username'          => ['required', 'string', 'min:3', 'max:255', 'unique:users,username,' . $user->id],
            'email'             => ['required', 'email', 'min:3', 'max:255', 'unique:users,email,' . $user->id],
            'old_password'      => ['required', 'string', 'min:5'], // Needed to verify the user
            'password'          => ['nullable', 'string', 'min:5', 'confirmed'],
            'gender_id'         => ['nullable', 'in:1,2,3'],
            'birth_date'        => ['required', 'date', 'before:2020-01-01', 'after:1990-01-01'],
            'bio'               => ['nullable', 'string', 'min:5', 'max:5000'],
            'profile_image'     => ['nullable', 'image', 'mimes:jpeg,jpg,png,avif,webp', 'max:5120'],
            'profile_banner'    => ['nullable', 'image', 'mimes:jpeg,jpg,png,avif,webp', 'max:5120'],
            'website'           => ['nullable', 'url', 'max:255'],
        ]);

        // Check if the provided old password matches the user's current password
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Old password is not correct']);
        }

        // If a new password is provided, hash it; otherwise, remove it from the validated data
        if (!empty($request->input('password'))) {
            $validated['password'] = Hash::make($request->input('password'));
        } else {
            unset($validated['password']);
        }

        // Handle profile image upload and deletion of old image if it exists
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $profile_image = $request->file('profile_image')->store('users', 'public');
            $validated['profile_image'] = $profile_image;
        }

        // Handle profile banner upload and deletion of old banner if it exists
        if ($request->hasFile('profile_banner')) {
            if ($user->profile_banner) {
                Storage::disk('public')->delete($user->profile_banner);
            }
            $profile_banner = $request->file('profile_banner')->store('users', 'public');
            $validated['profile_banner'] = $profile_banner;
        }

        // Update the user with the validated data
        if ($user->update($validated)) {
            return redirect()->route('user.profile')->with('success', 'Your account has been updated successfully!');
        }

        // Return an error if the update fails
        return redirect()->back()->with('error', 'There was an error while trying to update your account, try again later!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Display settings page
     */
    public function settingsView() {
        $user = Auth::user();
        $genders = Gender::all();
        return view('user.settings-view', compact('user', 'genders'));
    }

    /**
     * Update user info
     */
    public function updateInfo(Request $request) {
        $user = Auth::user();

        // Validate the incoming request data
        $validated = $request->validate([
            'name'              => ['required', 'string', 'min:3', 'max:255'],
            'username'          => ['required', 'string', 'min:3', 'max:255', 'unique:users,username,' . $user->id],
            'email'             => ['required', 'email', 'min:3', 'max:255', 'unique:users,email,' . $user->id],
            'gender_id'         => ['nullable', 'in:1,2,3'],
            'birth_date'        => ['required', 'date', 'before:2020-01-01', 'after:1990-01-01'],
            'bio'               => ['nullable', 'string', 'min:5', 'max:5000'],
            'website'           => ['nullable', 'url', 'max:255'],
        ]);

        // Set a default value for gender_id if not provided
        $validated['gender_id'] = $validated['gender_id'] ?? 3;

        // Update the user with the validated data
        if ($user->update($validated)) {
            return redirect()->back()->with('success', 'Your info  updated successfully!');
        }

        // Return an error if the update fails
        return redirect()->back()->with('error', 'There was an error while trying to update your info, try again later!');

    }

}
