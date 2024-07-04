<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Support\Facades\Auth;

class CommentLikeController extends Controller
{
    public function like(Comment $comment) {

        $user = Auth::user();
        $commentLike = CommentLike::where('user_id', $user->id)->where('comment_id', $comment->id)->first();

        if ($commentLike) {
            $commentLike->delete();
        } else {
            $commentLike = new CommentLike(['user_id' => $user->id, 'comment_id' => $comment->id]);
            $commentLike->save();
        }

        return redirect()->back();
        
    }
}
