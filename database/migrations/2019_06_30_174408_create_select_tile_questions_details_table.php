<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectTileQuestionsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('select_tile_questions_details', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('question_id')->unsigned();
            $table->string('stations');
            $table->string('place');
            $table->string('dora');
            $table->integer('me_score');
            $table->integer('kami_score');
            $table->integer('toi_score');
            $table->integer('shimo_score');
            $table->string('me_kawa')->nullable();
            $table->string('kami_kawa')->nullable();
            $table->string('toi_kawa')->nullable();
            $table->string('shimo_kawa')->nullable();
            $table->string('me_naki')->nullable();
            $table->string('kami_naki')->nullable();
            $table->string('toi_naki')->nullable();
            $table->string('shimo_naki')->nullable();
            $table->string('tehai');
            $table->foreign('question_id')->references('id')->on('select_tile_questions_lists'); // 外部キー
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('select_tile_questions_detail');
    }
}
