<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\SurveyResponse;

class StatisticsService
{
    public function all($qid) {
        $answers = Answer::where('question_id', $qid)->get();
        $statistics = [];

        foreach ($answers as $index => $answer) {
            $statistics[$index]['answer'] = $answer->answer;
            $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)->count();
        }

        return collect($statistics);
    }

    public function byCategory($qid, $category) {
        $answers = Answer::where('question_id', $qid)->get();
        $statistics = [];

        foreach ($answers as $index => $answer) {
            $statistics[$index]['answer'] = $answer->answer;
            if ($category == 'gender') {
                $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                    ->join('user_details', 'user_details.user_id', 'survey_responses.user_id')
                    ->count();
            }
            if ($category == 'age') {
                $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                    ->join('user_details', 'user_details.user_id', 'survey_responses.user_id')
                    ->count();
            }
            if ($category == 'country') {
                $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                    ->count();
            }
        }

        return collect($statistics);
    }

    public function byCategorySubcategory($qid, $category, $subcategory) {
        $answers = Answer::where('question_id', $qid)->get();
        $statistics = [];

        foreach ($answers as $index => $answer) {
            $statistics[$index]['answer'] = $answer->answer;
            if ($category == 'gender') {
                if ($subcategory != 'all') {
                    $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                        ->join('user_details', 'user_details.user_id', 'survey_responses.user_id')
                        ->where('user_details.gender', $subcategory)
                        ->count();
                }
                else {
                    $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                        ->join('user_details', 'user_details.user_id', 'survey_responses.user_id')
                        ->count();
                }
            }
            if ($category == 'age') {
                if ($subcategory == 0) {
                    $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                        ->join('user_details', 'user_details.user_id', 'survey_responses.user_id')
                        ->count();
                }
                if ($subcategory == 1) {
                    $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                        ->join('user_details', 'user_details.user_id', 'survey_responses.user_id')
                        ->whereRaw('DATEDIFF(now(), user_details.date_of_birth)/365 <= 10')
                        ->count();
                }
                if ($subcategory == 2) {
                    $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                        ->join('user_details', 'user_details.user_id', 'survey_responses.user_id')
                        ->whereRaw('DATEDIFF(now(), user_details.date_of_birth)/365 > 10 AND DATEDIFF(now(), user_details.date_of_birth)/365 <= 18')
                        ->count();
                }
                if ($subcategory == 3) {
                    $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                        ->join('user_details', 'user_details.user_id', 'survey_responses.user_id')
                        ->whereRaw('DATEDIFF(now(), user_details.date_of_birth)/365 > 18 AND DATEDIFF(now(), user_details.date_of_birth)/365 <= 28')
                        ->count();
                }
                if ($subcategory == 4) {
                    $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                        ->join('user_details', 'user_details.user_id', 'survey_responses.user_id')
                        ->whereRaw('DATEDIFF(now(), user_details.date_of_birth)/365 > 28')
                        ->count();
                }
            }
            if ($category == 'country') {
                if ($subcategory != 0) {
                    $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                        ->join('user_details', 'user_details.user_id', 'survey_responses.user_id')
                        ->where('user_details.country_id', $subcategory)
                        ->count();
                }
                else {
                    $statistics[$index]['vote'] = SurveyResponse::where('answer_id', $answer->id)
                        ->count();
                }
            }
        }

        return collect($statistics);
    }
}
