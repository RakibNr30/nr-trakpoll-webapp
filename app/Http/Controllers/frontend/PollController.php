<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Country;
use App\Models\Question;
use App\Services\StatisticsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Poll;
use App\Models\Survey;
use App\Models\Comment;
use App\Models\SurveyResponse;

class PollController extends Controller
{
    protected $statisticsService;
    public function __construct(StatisticsService $statisticsService)
    {
        $this->middleware('auth');
        $this->statisticsService = $statisticsService;
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

    public function store(Request $request, Poll $poll)
    {

        $data = request()->validate([
            'responses.*.answer_id' => 'required',
            'responses.*.question_id' => 'required',
            'survey.name' => 'required',
            'survey.email' => 'required|email',

        ]);
        $id = $request->responses;
        //dd($id);
        $survey = $poll->surveys()->create($data['survey']);
        $res = $survey->responses()->createMany($id);


        $notification = array(
            'message' => 'Survey Finished SuccessFully !!',
            'alert-type' => 'success'
        );
        return redirect()->route('user.polls.index')->with($notification);
    }

    public function surveyreports()
    {
        $id = Auth::guard('web')->user()->id;
        $responses = SurveyResponse::where('user_id', $id)->get();
        //dd($responses);
            // foreach($responses as $response){
            //     $qus_id = $response->question_id;
            //     $questions = Question::where('id', $qus_id)->first();
            //     $ans_id = $response->answer_id;
            //     $answers = Answer::where('id', $ans_id)->first();
            // }
            //return view('frontend.pages.polls.surveyreports.index', compact('questions', 'answers'));
        return view('frontend.pages.polls.surveyreports.index', compact('responses'));
    }

    public function commentindex()
    {
        $id = Auth::guard('web')->user()->id;
        $comments = Comment::where('user_id', $id)->get();
        return view('frontend.pages.polls.survey.comments.index', compact('comments'));
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

    /**
     * Display the specified resource.
     *
     * @param $pid
     * @param $qid
     * @return \Illuminate\Http\Response
     */
    public function statistics($pid, $qid)
    {
        if (\request()->has('category')) {
            $category = \request()->get('category');
            return response()->json();
        }

        $statistics = $this->statisticsService->all($qid);
        $answers = $statistics->pluck('answer');
        $votes = $statistics->pluck('vote');
        $question = Question::find($qid);
        $poll = Poll::find($pid);

        return view('frontend.pages.polls.survey.statistics', compact(
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
