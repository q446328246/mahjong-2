<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get_wining_qa/{level}/{volume}', 'ApiController@getWiningQA');
Route::get('get_select_questions', 'ApiController@getSelectTopQuestions');
Route::get('get_select_question_detail/{id}', 'ApiController@getSelectQuestionDetail');


Route::group(['middleware' => 'api'],function(){


});
