<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SelectTileQuestionsList extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
//    protected $appends = [];
    protected $guarded = [];

    // アソシエーション
    public function select_tile_question_detail() {
        return $this->hasOne(SelectTileQuestionsDetail::class, 'question_id');
    }

    public function select_tile_results() {
        return $this->hasMany(SelectTileResult::class, 'question_id');
    }
}
