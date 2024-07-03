<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Review;
use App\Models\User;

class HomePageController extends Controller
{
    public function index() {
        $books = Book::with(['user', 'language', 'genre', 'reviews', 'comments'])
                        ->OrderBy('id', 'desc')
                        ->paginate(8);
        $genres = Genre::with('books')->get();

        $reviews = Review::with(['user', 'book'])
                        ->OrderBy('id', 'desc')
                        ->paginate(4);
        return view('home.index', compact('books', 'genres', 'reviews'));
    }

    public function search(Request $request) {
        $validated = $request->validate([ 'query' => 'string|required' ]);
        $query = $request->input('query');


        // $users = User::where('username', 'LIKE', '%' . $query . '%')
        //     ->orWhere('email', 'LIKE', '%' . $query . '%')
        //     ->orWhere('name', 'LIKE', '%' . $query . '%')
        //     ->OrderBy('id', 'desc')
        //     ->paginate(12);

        $books = Book::with(['user', 'genre'])
            ->where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->OrderBy('id', 'desc')
            ->paginate(12);



        return view('home.search', compact('books', 'query'));
    }

    public function about() {
        return view('home.about');
    }

    public function privacyPolicy() {
        return view('home.privacy-policy');
    }

    public function termsAndConditions() {
        return view('home.terms-and-conditions');
    }
}
