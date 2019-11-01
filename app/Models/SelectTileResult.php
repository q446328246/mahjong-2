<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SelectTileResult extends Model
{
    protected $dates = ['deleted_at'];
//    protected $appends = [];
    protected  $fillable = ['question_id', 'answer', 'comment', 'display'];

    // アソシエーション
    public function select_tile_question_list() {
        return $this->belongsTo(SelectTileQuestionsList::class);
    }
}
