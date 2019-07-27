<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSelectTileQuestionsDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('select_tile_questions_details', function (Blueprint $table) {
            $table->string('tumo_tile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('select_tile_questions_details', function (Blueprint $table) {
            $table->dropColumn('tumo_tile');
        });
    }
}
