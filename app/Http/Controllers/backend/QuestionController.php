<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function create(Poll $poll)
    {
        ////Role Base Authentication Permision create
        // if (is_null($this->user) || !$this->user->can('poll.create')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        // }
        return view('backend.pages.polls.question.create', compact('poll'));
    }

    public function store(Poll $poll)
    {

        $data = request()->validate([
            'question.question' => 'required',
            'answers.*.answer' => 'required',
        ]);
       // dd($data);

        $question = $poll->questions()->create($data['question']);
        $question->answers()->createMany($data['answers']);

        $notification = array(
            'message' => 'Poll Question has been Created !!',
            'alert-type' => 'success'
        );
        return redirect('admin/polls/'.$poll->id)->with($notification);
    }

    public function edit(Poll $poll, Question $question)
    {
        ////Role Base Authentication Permision create
        // if (is_null($this->user) || !$this->user->can('poll.edit')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        // }

        $question= Question::where('poll_id', $poll->id)->first();
        $question->load('answers');
        //dd($question);
        return view('backend.pages.polls.question.edit', compact('poll','question'));
    }


    public function Update(Request $request,Poll $poll)
    {
        //dd($request->all());
        $answerid = $request->answer_id;
        $question = $request->question;
        $answers = $request->answer;

        for($i=0; $i<count($answers); $i++)
        {
            DB::table('answers')->where(['id'=>$answerid[$i]])->update(['answer'=>$answers[$i]]);
        }

        $notification = array(
            'message' => 'Poll Question has been Updated !!',
            'alert-type' => 'success'
        );

        return redirect('admin/polls/'.$poll->id)->with($notification);
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poll $poll, Question $question)
    {
        ////Role Base Authentication Permision create
        // if (is_null($this->user) || !$this->user->can('poll.delete')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        // }
       $question->answers()->delete();
       $question->delete();

       return redirect($poll->path());
    }
}
