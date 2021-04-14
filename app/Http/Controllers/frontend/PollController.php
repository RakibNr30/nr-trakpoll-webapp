<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Poll;
use App\Models\Survey;
use App\Models\Comment;


class PollController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showpoll()
    {
        $polls = Poll::all();
        //dd($polls);
        //$slug = Str::slug($polls->title);
        //dd($slug);
        return view('frontend.pages.polls.index', compact('polls'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showsurvey(Poll $poll)
    {
        //dd($poll);
        $poll->load('questions.answers');
        $survey = Survey::all();
        return view('frontend.pages.polls.survey.show', compact('poll', 'survey'));
    }

    public function store(Poll $poll)
    {
        dd(request()->all());
        $data = request()->validate([
            'responses.*.answer_id' => 'required',
            'responses.*.question_id' => 'required',
            'survey.name' => 'required',
            'survey.email' => 'required|email',

        ]);

        $survey = $poll->surveys()->create($data['survey']);
        $survey->responses()->createMany($data['responses']);

        $notification = array(
            'message' => 'Survey Finished SuccessFully !!',
            'alert-type' => 'success'
        );
        return redirect()->route('user.polls.index')->with($notification);
    }

    public function commentstore(Request $request, $poll)
    {
        $data = request()->validate([
            'comment' => 'required',
        ]);

        $comment = new Comment;
        $comment->poll_id = $poll;
        $comment->user_id = Auth::guard('web')->user()->id;
        $comment->comment = $request->comment;
        $comment->save();

        $notification = array(
            'message' => 'Comment has been Created !!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
