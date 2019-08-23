<?php

namespace App\Http\Controllers;

use App\Models\SelectTileQuestionsDetail;
use App\Models\SelectTileQuestionsList;
use App\Models\SelectTileResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function getWiningQA(Request $request, $level)
    {
        if (3 < $level) {
            return 'ボタンを押してください';
        }

        try {
            $Questions = DB::table('wining_lv1_questions')
                ->where('deleted_at', null)
    //            ->orderByRaw('RAND()')
    //            ->limit($volume)
                ->get();



            $response = [];
            foreach ($Questions as $key => $Question) {
                $Answers = DB::table('wining_lv1_answers')
                    ->where('question_id', $Question->id)
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
            $response = 'システムエラーが発生しました。';
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


    public function postSelectAnswer(Request $request) {
        try {
//            $SelectTileResult = SelectTileResult::create([
//                'answer' => $request['answer'],
//                'question_id' => $request['question']['id'],
//                'comment' => !empty($request['comment']) ?? '',
//                'display' => 0,
//            ]);

            $response['answer'] = DB::table('select_tile_results')
                        ->select('answer as hai', DB::raw('count(*) as count'))
                        ->where('question_id', '=', $request['question']['id'])
                        ->groupBy('answer')
                        ->get();

            $response['comment'] = DB::table('select_tile_results')
                ->select('answer as hai', 'comment')
                ->where('question_id', '=', $request['question']['id'])
                ->where('display', '=', 1)
                ->whereNotNull('comment')
                ->get();


        } catch (\Exception $e) {
            Log::warning($e->getMessage());

            $response = false;
        }

        return $response;
    }
}
