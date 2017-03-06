<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    /**
 * The table associated with the model.
 *
 * @var string
 */
    protected $table = 'answers';

    protected $fillable = ['question_id', 'content', 'is_correct', 'created_time', 'updated_time'];
}
