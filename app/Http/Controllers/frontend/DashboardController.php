<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Poll;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use App\Models\SurveyResponse;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $total_user = count(User::select('id')->get());
        $total_poll = count(Poll::select('id')->get());
        $total_question = count(Question::select('id')->get());
        $total_answer = count(Answer::select('id')->get());
        return view('frontend.pages.dashboard.index', compact('total_user', 'total_poll', 'total_question','total_answer'));
    }

    public function profile()
    {
        $user = Auth::user();
        $response = SurveyResponse::where('user_id', $user->id)->get();
        return view('frontend.pages.dashboard.profile',compact('user','response'));
    }
}
