<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'terms';

    protected $fillable = ['name', 'subject_id', 'created_time', 'updated_time'];

    public function questions(){
        return $this->hasMany('App\Questions', 'term_id');
    }
}
