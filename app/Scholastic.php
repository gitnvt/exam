<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scholastic extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'scholastic';

    /**
     * @var
     */
    protected $fillable = ['title', 'start', 'end', 'created_time', 'updated_time'];
}
