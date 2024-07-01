<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;

class HomePageController extends Controller
{
    public function index() {
        $books = Book::with(['user', 'language', 'genre', 'reviews', 'comments'])
                        ->OrderBy('id', 'desc')
                        ->paginate(16);
        $genres = Genre::with('books')->get();
        return view('home.index', compact('books', 'genres'));
    }

    public function search(Request $request) {
        $validated = $request->validate([ 'query' => 'string|required' ]);
        $query = $request->input('query');
        $result = Book::with(['user', 'language', 'genre', 'reviews', 'comments'])
            ->where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'LIKE', '%' . $query . '%')
            ->paginate(12);

        return view('home.search', compact('result', 'query'));
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
