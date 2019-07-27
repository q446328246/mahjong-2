<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QAController extends Controller
{
    public function index($volume) {
        if (10 < $volume) {
            return '問題数の限度を越しています。下記ボタンから問題数を選んでください';
        }
        $Questions = DB::table('question')
                    ->orderByRaw('RAND()')
                    ->limit($volume)
                    ->get();

        $response = [];
        foreach ($Questions as $key => $Question) {
            $Answers = DB::table('answer')
                ->where('question_id', $Question->id)
                ->get();

            $response[$key]['question'] = array(
                'question_key' => $key,
                'question' => $Question->question
            );

            foreach ($Answers as $Answer) {
                $response[$key]['answer'][] = array(
                    'question_key' => $key,
                    'answer_num' => $Question->answer_id,
                    'answer' => $Answer->answer,
                    'correct' => $Answer->correct,
                );
            }
        }

        return $response;
    }
}
