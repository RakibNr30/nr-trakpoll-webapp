<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Survey;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Poll $poll, $slug)
    {
        //dd($poll);
        $poll->load('questions.answers');
        $survey = Survey::all();
        return view('backend.pages.polls.survey.show', compact('poll', 'survey'));
    }

    public function store(Poll $poll)
    {
        //dd(request()->all());
        $data = request()->validate([
            'responses.*.answer_id' => 'required',
            'responses.*.question_id' => 'required',
            'survey.name' => 'required',
            'survey.email' => 'required|email',
            
        ]);

        $survey = $poll->surveys()->create($data['survey']);
        $survey->responses()->createMany($data['responses']);

        return redirect('admin/polls/index');
    }
}
