<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    /**
     * Some const variable
     */
    const RANDOM = 1;
    const MANUAL = 2;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exams';

    protected $fillable = ['subject_id', 'title', 'instruction', 'show_answer_correct', 'total_questions',
        'total_time', 'start_time', 'end_time', 'status', 'created_time', 'updated_time'];

    public function subject(){
        return $this->belongsTo('App\Subjects', 'subject_id');
    }

    public function questions(){
        return $this->belongsToMany('App\Questions', 'exam_question', 'exam_id', 'question_id');
    }

    public function examMatrix(){
        return $this->hasMany('App\ExamMatrix', 'exam_id');
    }
}
