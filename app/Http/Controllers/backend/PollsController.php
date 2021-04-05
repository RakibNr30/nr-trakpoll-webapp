<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\Poll;
use App\Models\Question;


class PollsController extends Controller
{
    public $user;
    

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
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
        $polls = Poll::all();
        return view('backend.pages.polls.showdata', compact('polls'));
    }

    //approved Poll--------
    public function poll_approved(Request $request, $id)
    {
        DB::table('polls')
                ->where('id', $id)
                ->update(['status'=> 0]);
                
                $notification = array(
                    'message' => 'Poll has been Approved !!',
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
                    'message' => 'Poll has been Disapproved !!',
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
}
