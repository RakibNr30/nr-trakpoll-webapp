<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Poll;
use App\Models\Question;
use App\Models\User;

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
        return view('frontend.pages.dashboard.index', compact('total_user', 'total_poll', 'total_question'));
    }    
}
