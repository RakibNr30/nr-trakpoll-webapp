<?php

namespace App\Http\Controllers\backend;

use App\Charts\PollChart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Poll;
use App\Models\Question;
use App\Models\SurveyResponse;
use App\Models\User;

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

        return view('backend.pages.dashboard.index', compact(
            'total_admin',
            'total_user',
            'total_poll',
            'total_question'
        ));
    }

    public function poll_search(Request $request, Poll $poll)
    {
        $data = request()->validate([
            'searchfrom' => 'required',
            'searchto' => 'required',
        ]);

        $search_from = $request->searchfrom;
        $search_to = $request->searchto;

        $search_polls = Poll::where('created_at', '>=', $search_from)
                            ->where('created_at', '<=', $search_to)
                            ->orderBy('id', 'desc')
                            ->get();
        return view('backend.pages.polls.search', compact('search_from','search_to','search_polls', 'polls'));

    }

    public function profile()
    {
        $id = Auth::guard('admin')->user()->id;
        $admin = Admin::where('id',$id)->first();
        //dd($admin);
        return view('backend.pages.dashboard.profile',compact('admin'));
    }
}
