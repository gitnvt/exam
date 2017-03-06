<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subjects';

    protected $fillable = ['code', 'name', 'description', 'semester_id',
        'scholastic_id', 'created_time', 'updated_time'];

    public function scholastic(){
        return $this->belongsTo('App\Scholastic', 'scholastic_id');
    }

    public function semester(){
        return $this->belongsTo('App\Semester', 'semester_id');
    }

    public function questions(){
        return $this->hasMany('App\Questions', 'subject_id');
    }

    public function terms(){
        return $this->hasMany('App\Terms', 'subject_id');
    }

    public function exams()
    {
        return $this->hasMany('App\Exams', 'subject_id');
    }
}
