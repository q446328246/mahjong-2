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
//     // 記事を投稿す処理
//     Route::post('/article/{id}',function($id){
//         //投稿するユーザーを取得
//         $user = App\User::where('id',$id)->first();

//         //リクエストデータを元に記事を作成
//         $article = new App\Article();
//         $article->title = request('title');
//         $article->content = request('content');

//         //ユーザーに関連づけて保存
//         $user->articles()->save($article);

//         //テストのためtitile、contentのデータをリターン
//         return ['title' => request('title'),'content' => request('content')];
//     });



});
