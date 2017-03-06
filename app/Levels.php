<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'levels';

    protected $fillable = ['name', 'created_time', 'updated_time'];
}
