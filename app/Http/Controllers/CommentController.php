<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validated = $request->validate([
            'comment' => ['required', 'string', 'min:5', 'max:5000'],
            'book_id' => ['required', 'integer'],
        ]);

        $validated['user_id'] = Auth::id();

        $comment = New Comment( $validated );

        if ($comment->save()) {
            return redirect()->back()->with('comment_success', 'Comment published succssfuly!');
        }

        return redirect()->back()->with('comment_error', 'There was an error while trying to published your comment!');
    }

    /**
     * Reply to comment form view
     */
    public function reply(Comment $comment)
    {
        return view('comment.reply-form', compact('comment'));
    }

    /**
     * Store the reply into the database
     */
    public function replyStore(Request $request)
    {
        $validated = $request->validate([
            'reply'     => ['required', 'string', 'min:5', 'max:5000'],
            'book_id'   => ['required', 'integer', 'exists:books,id'],
            'parent_id' => ['required', 'integer', 'exists:comments,id'],
        ]);
        $validated['comment'] = $request->input('reply');
        $validated['user_id'] = Auth::id();
        unset( $validated['reply'] );

        $comment = New Comment( $validated );

        if ($comment->save()) {
            return redirect()->back()->with('comment_success', 'Comment published succssfuly!');
        }

        return redirect()->back()->with('comment_error', 'There was an error while trying to published your comment!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        if (! Gate::allows('update-comment', $comment)) {
            abort(403);
        }

        return view('comment.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        if (! Gate::allows('update-comment', $comment)) {
            abort(403);
        }

        $validated = $request->validate([
            'comment' => ['required', 'string', 'min:5', 'max:5000'],
        ]);


        if ($comment->update( $validated )) {

            return redirect()->back()->with('comment_success', 'Comment updated succssfuly!');

        }

        return redirect()->back()->with('comment_error', 'There was an error while trying to update your comment!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        if (! Gate::allows('update-comment', $comment)) {
            abort(403);
        }

        if ($comment->delete()) {
            return redirect()->back()->with('comment_success', 'Comment deleted succssfuly!');
        }
        return redirect()->back()->with('comment_error', 'There was an error while trying to delete your comment!');
    }
}
