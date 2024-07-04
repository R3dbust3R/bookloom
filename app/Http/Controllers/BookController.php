<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\Genre;
use App\Models\Language;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with(['user', 'language', 'genre', 'comments'])
                ->orderBy('id', 'desc')
                ->paginate(12);
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
        $comments = Comment::where('book_id', $book->id)->with(['user', 'likedBy'])->OrderBy('id', 'desc')->get();
        $reviews = Review::where('book_id', $book->id)->with('user')->OrderBy('id', 'desc')->get();

        $book->views += 1;
        $book->save();

        return view('book.show', compact('book', 'comments', 'reviews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $languages = Language::all();
        $genres = Genre::all();
        return view('book.edit', compact('book', 'languages', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'         => ['required', 'string', 'min:3', 'max:255'],
            'description'   => ['required', 'string', 'min:100', 'max:5000'],
            'author'        => ['required', 'string', 'min:3', 'max:255'],
            'language_id'   => ['nullable'],
            'genre_id'      => ['nullable'],
            'page_count'    => ['nullable', 'integer', 'max:20000'],
            'cover'         => ['nullable', 'image', 'mimes:jpeg,jpg,png,avif,webp', 'max:5120'],
        ]);

        
        $validated['language_id'] = in_array($request->input('language_id'), [1,2,3]) ? $request->input('language_id') : 2;
        $validated['genre_id'] = in_array($request->input('genre_id'), [1,2,3,4,5]) ? $request->input('genre_id') : 1;

        $validated['user_id'] = $book->user_id;
        $validated['book_url'] = $book->book_url;

        if ($request->hasFile('cover')) {
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            $cover = $request->file('cover')->store('books', 'public');
            $validated['cover'] = $cover;
        }

        if ($book->update( $validated )) {
            return redirect()->back()->with('success', 'Your book has been updated successuly!');
        } 

        return redirect()->back()->with('error', 'There was an error while trying to update your book, try again later');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {

        if ($book->delete()) {

            Storage::disk('public')->delete($book->book_url);
            
            if ($book->cover) {
                Storage::disk('public')->delete($book->cover);
            }
            
            return redirect()->route('user.profile')->with('success', $book->title . ' has been deleted successfuly!');
        }

        abort(403, 'No such media to delete');

    }

    public function read(Book $book) {
        return view('book.read', compact('book'));
    }

    public function download(Book $book) {
        $book_download_url = asset('storage/' . $book->book_url);

        $book->downloaded_times += 1;
        $book->update();

        return redirect()->to($book_download_url);
    }

}
