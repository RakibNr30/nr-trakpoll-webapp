<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poll;

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
        return view('frontend.pages.polls.index', compact('polls'));
    }
}
