<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamMatrix extends Model
{
    protected $table = 'exam_matrix';

    protected $fillable = ['exam_id', 'term_id', 'level_id', 'quantity', 'created_time', 'updated_time'];

    public function exam(){
        return $this->belongsTo('App\Exams', 'exam_id');
    }
}
