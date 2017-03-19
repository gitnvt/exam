<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'results';

    protected $fillable = ['exam_id', 'exam_code', 'user_id', 'start_time', 'time_spent', 'score', 'draft', 'created_time', 'updated_time'];

    public function rsAnswers(){
        return $this->hasMany('App\ResultAnswer', 'result_id');
    }

    public function questions(){
        return $this->belongsToMany('App\Questions', 'result_answer', 'result_id', 'question_id');
    }
}
