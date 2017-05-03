<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamineeExamcode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'examinee_examcode';

    protected $fillable = ['user_id', 'exam_code', 'created_time', 'updated_time'];
}
