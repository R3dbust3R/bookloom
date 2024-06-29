<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['user', 'language', 'genre', 'comments'])->paginate(12);
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::all();
        $genres = Genre::all();
        return view('book.create', compact('languages', 'genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => ['required', 'string', 'min:3', 'max:255'],
            'description'   => ['required', 'string', 'min:100', 'max:5000'],
            'author'        => ['required', 'string', 'min:3', 'max:255'],
            'language_id'   => ['nullable'],
            'genre_id'      => ['nullable'],
            'page_count'    => ['nullable', 'integer', 'max:20000'],
            'cover'         => ['nullable', 'image', 'mimes:jpeg,jpg,png,avif,webp', 'max:5120'],
            'book_url'      => ['required', 'file', 'mimes:pdf', 'max:20480'],
        ]);

        
        $validated['language_id'] = in_array($request->input('language_id'), [1,2,3]) ? $request->input('language_id') : 2;
        $validated['genre_id'] = in_array($request->input('genre_id'), [1,2,3,4,5]) ? $request->input('genre_id') : 1;

        $validated['user_id'] = Auth::user()->id;

        $book_url = $request->file('book_url')->store('books/books', 'public');

        $validated['book_url'] = $book_url;

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover')->store('books', 'public');
            $validated['cover'] = $cover;
        }

        $book = New Book( $validated );

        if ($book->save()) {
            return redirect()->back()->with('success', 'Your book has been upload successuly!');
        } 

        return redirect()->back()->with('error', 'There was an error while trying to upload your book, try again later');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }

    public function read(Book $book) {
        return view('book.read', compact('book'));
    }

    // public function download(Book $book) {
    //     return 'download this book: ' . $book->title;
    // }

}
