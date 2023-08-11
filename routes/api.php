<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\SurveyQuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('survey')->group(function () {
    Route::get('/index', [SurveyController::class, 'index']);
    Route::post('', [SurveyController::class, 'store']);
    Route::patch('/update/{survey}', [SurveyController::class, 'update']);
});

Route::prefix('question')->group(function () {
    Route::get('/index', [QuestionController::class, 'index']);
    Route::post('', [QuestionController::class, 'store']);
    Route::patch('/update/{question}', [QuestionController::class, 'update']);
    Route::post('/delete', [QuestionController::class, 'destroy']);
});

Route::prefix('survey_question')->group(function () {
    Route::post('', [SurveyQuestionController::class, 'store']);
});