<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions';

    protected $fillable = ['subject_id', 'term_id', 'level', 'content', 'created_time', 'updated_time'];

    public function term(){
        return $this->belongsTo('App\Terms', 'term_id');
    }

    public function getLevel(){
        return $this->belongsTo('App\Levels', 'level');
    }

    public function answers(){
        return $this->hasMany('App\Answers', 'question_id');
    }
}
