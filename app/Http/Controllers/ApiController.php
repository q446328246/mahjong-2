<?php

namespace App\Http\Controllers;

use App\Models\SelectTileQuestionsDetail;
use App\Models\SelectTileQuestionsList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getWiningQA(Request $request, $level, $volume)
    {
        if (3 < $level) {
            return 'ボタンを押してください';
        }

        try {
            $Questions = DB::table('wining_lv1_questions')
                ->whereNull('deleted_at')
                ->orderByRaw('RAND()')
                ->limit($volume)
                ->get();

            $response = [];
            foreach ($Questions as $key => $Question) {
                $Answers = DB::table('wining_lv1_answers')
                    ->where('question_id', $Question->id)
                    ->whereNull('deleted_at')
                    ->get();

                $response[$key]['question'] = array(
                    'question_key' => $key,
                    'question' => $Question->question
                );

                foreach ($Answers as $Answer) {
                    $response[$key]['answer'][] = array(
                        'question_key' => $key,
                        'answer' => $Answer->answer,
                        'correct' => $Answer->correct,
                    );
                }
            }
        } catch (\Exception $e) {
            Log::warning($e->getMessage());
        }

        return $response;
    }

    public function getSelectTopQuestions(Request $request)
    {
        try {
            $Questions = SelectTileQuestionsList::with('select_tile_results')->get();


            $response = [];

            foreach ($Questions as $key => $Question) {
                $response[$key]['question'] = array(
                    'ans_cnt' => count($Question->select_tile_results),
                    'Question' => $Question
                );
            }
        } catch (\Exception $e) {
            Log::warning($e->getMessage());
        }

        return $response;
    }

    public function getSelectQuestionDetail(Request $request, $id)
    {
        try {
            $response = [];
            $response = SelectTileQuestionsDetail::where('question_id',$id)->get();

        } catch (\Exception $e) {
            Log::warning($e->getMessage());
        }

        return $response;
    }
}
