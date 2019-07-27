<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SelectTileQuestionsDetail extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
//    protected $appends = [];
    protected $guarded = [];

    // アソシエーション
    public function select_tile_question_list() {
        return $this->belongsTo(SelectTileQuestionsList::class);
    }
}
