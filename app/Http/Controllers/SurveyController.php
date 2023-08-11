<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Http\Requests\StoreSurveyRequest;
use App\Http\Requests\UpdateSurveyRequest;
use App\Models\SurveyQuestion;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Survey::with('questions')->orderBy('created_at')->get();
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
     * @param  \App\Http\Requests\StoreSurveyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSurveyRequest $request)
    {
        $survey = new Survey();
        $survey->name = $request->name;
        $survey->description = $request->description;
        $survey->save();

        foreach ($request->questionIds as $questionId) {
            $survey_question = new SurveyQuestion();
            $survey_question->survey_id = $survey->id;
            $survey_question->question_id = $questionId;
            $survey_question->save();
        }

        return response()->json(['error' => false, 'message' => 'Survey created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSurveyRequest  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSurveyRequest $request, Survey $survey)
    {
        $survey->name = $request->name;
        $survey->description = $request->description;
        $survey->save();

        SurveyQuestion::where('survey_id', $survey->id)->delete();

        foreach ($request->questionIds as $questionId) {
            $survey_question = new SurveyQuestion();
            $survey_question->survey_id = $survey->id;
            $survey_question->question_id = $questionId;
            $survey_question->save();

            // Update the updated_at column in case nothing in the Survey model changed
            $survey->touch();
        }

        return response()->json(['error' => false, 'message' => 'Survey updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
