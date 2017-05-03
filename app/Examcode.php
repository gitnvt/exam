<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examcode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exam_code';

    protected $fillable = ['exam_id', 'exam_code', 'created_time', 'updated_time'];
}
