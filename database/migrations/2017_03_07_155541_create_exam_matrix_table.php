<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamMatrixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_matrix', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exam_id');
            $table->integer('term_id');
            $table->integer('level_id');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exam_matrix');
    }
}
