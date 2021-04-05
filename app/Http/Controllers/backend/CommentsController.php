<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('backend.pages.polls.survey.comments.index', compact('comments'));
    }
    public function store(Request $request, $poll)
    {
        $data = request()->validate([
            'comment' => 'required',
            // 'name' => 'required',
            // 'email' => 'required',
        ]);

        $comment = new Comment;
        $comment->poll_id = $poll;
        $comment->user_id = Auth::guard('admin')->user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        $notification = array(
            'message' => 'Comment has been Created !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function destory($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        $notification = array(
            'message' => 'Comment has been Deleted !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
