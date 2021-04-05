<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Poll;
use App\Models\Question;
use App\Models\User;
use App\Charts\SampleChart;

class DashboardController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }
    
    public function index()
    {
        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view dashboard !');
        }

        $total_admin = count(Admin::select('id')->get());
        $total_user = count(User::select('id')->get());
        $total_poll = count(Poll::select('id')->get());
        $total_question = count(Question::select('id')->get());


        return view('backend.pages.dashboard.index', compact('total_admin', 'total_user', 'total_poll', 'total_question'));
    }

    public function poll_search(Request $request, Poll $poll)
    {
        $data = request()->validate([
            'search' => 'required',
        ]);

        $poll_search = $request->search;

        $search_polls = Poll::orWhere('created_at', 'like', '%'.$poll_search.'%')
            ->orderBy('id', 'desc')
            ->get();
        //dd($search_polls);


        return view('backend.pages.polls.search', compact('poll_search', 'search_polls', 'polls'));

    }
}
