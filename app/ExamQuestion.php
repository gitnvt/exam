<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exam_question';

    protected $fillable = ['exam_id', 'question_id', 'created_time', 'updated_time'];
}
