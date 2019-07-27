<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('qa.json/{id}', 'QAController@index');
Route::get('test', 'TestController@index');

Route::get('/', function () {
    return view('welcome');
});

// API
Route::get('get_wining_qa/{level}', 'ApiController@getWiningQA');
Route::get('get_select_questions', 'ApiController@getSelectTopQuestions');
Route::get('get_select_question_detail/{id}', 'ApiController@getSelectQuestionDetail');

// 管理者画面
//Auth::routes();
// Route::get('admin', 'Admin\AdminController@index');
// Route::resource('admin/post', 'Admin\AdminPostController');

//Route::prefix('admin')->group(function() {
//    Route::get('/',         function () { return redirect('/admin/home'); });
//    Route::get('login',     'Admin\LoginController@showLoginForm')->name('admin.login');
//    Route::post('login',    'Admin\LoginController@login');
//    Route::get('logout',    'Admin\LoginController@logout')->name('admin.logout');
//});


//Route::prefix('admin')->middleware('auth:admin')->group(function() {
////     Route::get('/',         function () { return redirect('/admin/home'); });
//    Route::get('/home', 'Admin\AdminController@index')->name('admin.home');
//    Route::resource('/post', 'Admin\AdminPostController');
//});

Route::get('/{any}', function () {
    return view('vue_app');
})
->where('any', '.*');

// Route::get('/home', 'HomeController@in::dex')->name('home');
