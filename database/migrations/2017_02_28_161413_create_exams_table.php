<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id');
            $table->string('title');
            $table->text('instruction');
            $table->boolean('show_answer_correct')->nullable();
            $table->boolean('shuffle_question')->nullable();
            $table->boolean('shuffle_answer')->nullable();
            $table->integer('total_questions');
            $table->integer('total_time');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->boolean('status');
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
        //
        Schema::drop('exams');
    }
}
