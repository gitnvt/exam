<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamMatrix extends Model
{
    protected $table = 'exam_matrix';

    protected $fillable = ['exam_id', 'term_id', 'level_id', 'quantity', 'is_random', 'bank_id', 'created_time', 'updated_time'];

    public function exam(){
        return $this->belongsTo('App\Exams', 'exam_id');
    }

    public function term(){
        return $this->belongsTo('App\Terms', 'term_id');
    }

    public function level(){
        return $this->belongsTo('App\Levels', 'level_id');
    }

    public function bank(){
        return $this->belongsTo('App\QuestionBanks', 'bank_id');
    }
}
