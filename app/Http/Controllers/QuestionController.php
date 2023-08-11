<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\SurveyQuestion;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Question::all();
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
     * @param  \App\Http\Requests\StoreQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        $question = new Question();
        $question->name = $request->name;
        $question->text = $request->text;
        $question->type = $request->type;
        $saved = $question->save();

        if ($saved) {
            response()->json(['error' => false, 'message' => 'Question saved successfully']);
        } else {
            response()->json(['error' => true, 'message' => 'Unable to save Question']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionRequest  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->name = $request->name;
        $question->text = $request->text;
        $question->type = $request->type;
        $question->save();

        return response()->json(['error' => false, 'message' => 'Question updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->deleteIds;

        Question::whereIn('id', $ids)->delete();
        SurveyQuestion::whereIn('question_id', $ids)->delete();
        
        return response()->json(['error' => false, 'message' => 'Questions deleted successfully']);
    }
}
