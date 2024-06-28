<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index() {
        $books = Book::with(['user', 'language', 'genre', 'comments'])->OrderBy('id', 'desc')->paginate(4);
        return view('home.index', compact('books'));
    }

    public function about() {
        return view('home.about');
    }
}
