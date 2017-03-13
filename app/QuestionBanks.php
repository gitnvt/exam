<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionBanks extends Model
{
    protected $table = 'question_banks';

    protected $fillable = ['name', 'created_time', 'updated_time'];

    public function questions(){
        return $this->hasMany('App\Questions', 'bank_id');
    }
}
