<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'semester';

    protected $fillable = ['name', 'scholastic_id', 'created_time', 'updated_time'];

    public function scholastic(){
        return $this->belongsTo('App\Scholastic', 'scholastic_id');
    }
}
