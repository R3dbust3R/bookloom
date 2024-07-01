<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with(['user', 'book'])
            ->OrderBy('id', 'desc')
            ->paginate(12);
        return view('review.index', compact('reviews'));
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
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'review' => ['required', 'string', 'min:5', 'max:255'],
            'book_id' => ['required', 'integer'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);
        $validated['user_id'] = Auth::id();

        $review = Review::where('user_id', Auth::id())->where('book_id', $validated['book_id'])->first();

        if (! $review) {
            $review = New Review( $validated );
            $review->save();

            return redirect()->back()->with('review_success', 'Your review has been published successfuly!');
        }
        
        $review = $review->update($validated);
        
        return redirect()->back()->with('review_success', 'Your review has been published successfuly!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        if ($review->delete()) {
            return redirect()->back()->with('review_success', 'Your review has been deleted successfuly!');
        }
        return redirect()->back()->with('review_success', 'There was an error while trying to delete your review!');
    }
}
