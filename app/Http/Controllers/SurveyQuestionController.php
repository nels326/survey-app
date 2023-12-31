<?php

namespace App\Http\Controllers;

use App\Models\SurveyQuestion;
use App\Http\Requests\StoreSurveyQuestionRequest;
use App\Http\Requests\UpdateSurveyQuestionRequest;

class SurveyQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSurveyQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSurveyQuestionRequest $request)
    {
        $survey_ids = $request->surveyIds;
        $question_ids = $request->questionIds;

        foreach ($survey_ids as $survey_id) {
            foreach ($question_ids as $question_id) {
                $exists = SurveyQuestion::where('survey_id', $survey_id)->where('question_id', $question_id)->exists();
                
                if (!$exists) {
                    $survey_question = new SurveyQuestion();
                    $survey_question->survey_id = $survey_id;
                    $survey_question->question_id = $question_id;
                    $survey_question->save();
                }
            }
        }

        return response()->json(['error' => false, 'message' => 'Questions assigned successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SurveyQuestion  $surveyQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(SurveyQuestion $surveyQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SurveyQuestion  $surveyQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(SurveyQuestion $surveyQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSurveyQuestionRequest  $request
     * @param  \App\Models\SurveyQuestion  $surveyQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSurveyQuestionRequest $request, SurveyQuestion $surveyQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SurveyQuestion  $surveyQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(SurveyQuestion $surveyQuestion)
    {
        //
    }
}
