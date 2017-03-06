<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResultAnswer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'result_answer';

    protected $fillable = ['result_id', 'question_id', 'answer', 'correct', 'created_time', 'updated_time'];

    public function question(){
        return $this->belongsTo('App\Questions', 'question_id');
    }
}
