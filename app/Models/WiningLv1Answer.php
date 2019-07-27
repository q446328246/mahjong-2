<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\WiningLv1Question;

class WiningLv1Answer extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
//    protected $appends = [];
    protected $guarded = [];

    // アソシエーション
    public function wining_lv1_question() {
        return $this->belongsTo(WiningLv1Question::class);
    }
}
