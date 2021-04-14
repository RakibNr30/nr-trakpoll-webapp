<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Question;
use App\Models\Country;
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

        $Getcountrylist = Country::all();
        return view('backend.pages.polls.question.create', compact('poll','Getcountrylist'));
    }

    public function store(Request $request, Poll $poll)
    {
        $data = $request->validate([
            'question' => 'required',
            'answers.*.answer' => 'required',
            'country_ids' => 'required|min:1'
        ]);

        $data['country_ids'] = array_map('intval', $data['country_ids']);

        $question = $poll->questions()->create($data);

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

        //$question= Question::find($question->id);
        $question->load('answers');
        $Getcountrylist = Country::all();
        //dd($question);
        return view('backend.pages.polls.question.edit', compact('poll','question', 'Getcountrylist'));
    }


    public function Update(Request $request, Poll $poll)
    {
        //dd($request->all());
        $answerid = $request->answer_id;
        $questionid = $request->question_id;
        $question = $request->question;
        $answers = $request->answer;

        $dataRequest = $request->all();
        $data = [
            'question' => $dataRequest['question'],
            'country_ids' => $dataRequest['country_ids'] = array_map('intval', $dataRequest['country_ids'])
        ];

        DB::table('questions')->where('id', $dataRequest['question_id'])->update($data);

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
