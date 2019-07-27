<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\WiningLv1Answer;

class WiningLv1Question extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
//    protected $appends = [];
    protected $guarded = [];

    // アソシエーション
    public function wining_lv1_answers() {
        return $this->hasMany(WiningLv1Answer::class, 'question_id');
    }
}
