<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        $total = $comments->count();

        return view('about', [
            'total' => $total,
            'comments' => $comments,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|min:5',
        ]);

        // CREATING
        Comment::create([
            'body' => $request->input('comment'),
            'user_id' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $notification = array(
            'message' => 'You successfully posted a comment!',
            'alert-type' => 'success'
        );

        return redirect()
            ->route('about')
            ->with($notification);
    }
}
