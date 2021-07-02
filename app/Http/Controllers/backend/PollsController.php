<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Services\StatisticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\Poll;
use App\Models\Question;
use App\Models\SurveyResponse;

class PollsController extends Controller
{
    public $user;
    protected $statisticsService;


    public function __construct(StatisticsService $statisticsService)
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });

        $this->statisticsService = $statisticsService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ////Role Base Authentication Permision create
        if (is_null($this->user) || !$this->user->can('poll.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $polls = Poll::orderBy('id', 'DESC')->get();
        return view('backend.pages.polls.showdata', compact('polls'));
    }

    //approved Poll--------
    public function poll_approved(Request $request, $id)
    {
        DB::table('polls')
            ->where('id', $id)
            ->update(['status'=> 0]);

        $notification = array(
            'message' => 'Poll has been Dispproved !!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.polls.index')->with($notification);
    }

    //disapproved Poll--------
    public function poll_disapproved(Request $request, $id)
    {
        DB::table('polls')
            ->where('id', $id)
            ->update(['status'=> 1]);

        $notification = array(
            'message' => 'Poll has been Approved !!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.polls.index')->with($notification);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ////Role Base Authentication Permision create
        if (is_null($this->user) || !$this->user->can('poll.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        return view('backend.pages.polls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = request()->validate([
            'title' => 'required',
            'purpose' => 'required',
        ]);


        $polls = Auth::guard('admin')->user()->polls()->create($data);

        $notification = array(
            'message' => 'Poll has been Created !!',
            'alert-type' => 'success'
        );
        return redirect('admin/polls/'.$polls->id)->with($notification);
    }
    //duplicate method are here
    public function duplicate($id)
    {

        $poll = Poll::where('id', $id)->first();

        $polls = new Poll();
        $polls->title = $poll->title;
        $polls->purpose = $poll->purpose;
        $polls->admin_id = Auth::guard('admin')->user()->id;
        $polls->save();


        $notification = array(
            'message' => 'Poll has been Duplicated !!',
            'alert-type' => 'success'
        );
        return redirect('admin/polls/'.$polls->id)->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll)
    {
        ////Role Base Authentication Permision create
        if (is_null($this->user) || !$this->user->can('poll.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $poll->load('questions.answers.responses');



        // foreach ($poll_id->id as $s_id){
        //     $survey_id = SurveyResponse::where('survey_id',$s_id)->get();

        //     foreach ($survey_id as $survey_id){
        //         $survey_id->user_id;
        //     }
        // }
        //dd($poll);
        return view('backend.pages.polls.show', compact('poll'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Poll $poll)
    {
        ////Role Base Authentication Permision create
        if (is_null($this->user) || !$this->user->can('poll.edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $poll= Poll::where('id', $poll->id)->first();
        //dd($poll);
        return view('backend.pages.polls.edit', compact('poll'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poll $poll)
    {
        $poll = Poll::find($poll->id);
        $poll->title = $request->title;
        $poll->purpose = $request->purpose;
        //dd($poll);
        $poll->save();

        $notification = array(
            'message' => 'Poll has been Updated !!',
            'alert-type' => 'success'
        );
        return redirect('admin/polls/index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll, Question $question)
    {

        //dd($question->answers());
        dd($poll->questions());

        // $question->answers()->delete();
        // $question->delete();
        // $poll->delete();

        // return redirect($poll->path());
    }

    /**
     * Display the specified resource.
     *
     * @param $pid
     * @param $qid
     * @return \Illuminate\Http\Response
     */
    public function statistics($pid, $qid)
    {
        if (is_null($this->user) || !$this->user->can('poll.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        if (\request()->has('category')) {
            $category = \request()->get('category');
            return response()->json();
        }

        $statistics = $this->statisticsService->all($qid);
        $answers = $statistics->pluck('answer');
        $votes = $statistics->pluck('vote');
        $question = Question::find($qid);
        $poll = Poll::find($pid);

        return view('backend.pages.polls.statistics', compact(
            'answers','votes', 'question', 'poll'
        ));

    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function statisticsByCategory(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('poll.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $statistics = $this->statisticsService->byCategorySubcategory($request->qid, $request->category, $request->subcategory);
        $answers = $statistics->pluck('answer');
        $votes = $statistics->pluck('vote');

        $response = array(
            'status' => 'success',
            'answers' => $answers,
            'votes' => $votes,
        );

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function statisticsCategory(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('poll.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        if ($request->category == 'all') {
            $subCategories = collect([
                'all' => 'All',
            ]);
        }
        if ($request->category == 'gender') {
            $subCategories = collect([
                'all' => 'All',
                'male' => 'Male',
                'female' => 'Female',
                'others' => 'Others'
            ]);
        }
        if ($request->category == 'age') {
            $subCategories = collect([
                0 => 'All',
                1 => '0-10',
                2 => '11-18',
                3 => '19-28',
                4 => '28+'
            ]);
        }
        if ($request->category == 'country') {
            $question = Question::find($request->qid);
            $selectedCountryIds = [];
            if ($question->country_ids != null) {
                $selectedCountryIds = $question->country_ids;
            }
            $subCategories = array([
                0 => 'All'
            ]);
            foreach ($selectedCountryIds as $selectedCountryId) {
                $subCategories[$selectedCountryId] = Country::find($selectedCountryId)->name;
            }
        }

        $statistics = $this->statisticsService->all($request->qid);
        $answers = $statistics->pluck('answer');
        $votes = $statistics->pluck('vote');

        $response = array(
            'status' => 'success',
            'subCategories' => collect($subCategories),
            'answers' => $answers,
            'votes' => $votes,
        );

        return response()->json($response);
    }
}
