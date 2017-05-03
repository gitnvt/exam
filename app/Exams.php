<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Components\Activitylog\LogsActivityInterface;
use App\Components\Activitylog\LogsActivity;

class Exams extends Model implements LogsActivityInterface
{
    use LogsActivity;
    /**
     * Some const variable
     */
    const RANDOM = 1;
    const MANUAL = 2;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exams';

    protected $fillable = ['subject_id', 'title', 'instruction', 'show_answer_correct', 'total_questions',
        'total_time', 'start_time', 'end_time', 'status', 'created_time', 'updated_time'];

    public function subject(){
        return $this->belongsTo('App\Subjects', 'subject_id');
    }

    public function questions(){
        return $this->belongsToMany('App\Questions', 'exam_question', 'exam_id', 'question_id');
    }

    public function examMatrix(){
        return $this->hasMany('App\ExamMatrix', 'exam_id');
    }


    /**
     * Get the message that needs to be logged for the given event.
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getActivityDescriptionForEvent($eventName)
    {
        if ($eventName == 'created')
        {
            return json_encode([
                'title' => ('Created ' . $this->title),
            ]);
        }

        if ($eventName == 'updated')
        {
            return json_encode([
                'title' => ('Updated ' . $this->title),
            ]);
        }

        if ($eventName == 'deleted')
        {
            return json_encode([
                'title' => ('Deleted ' . $this->title),
            ]);
        }

        return '';
    }

    public function getAttributesForLog($eventName)
    {
        if ($eventName == 'created')
        {
            return ['type' => 'system', 'model' => $this->table, 'action' => 'create'];
        }

        if ($eventName == 'updated')
        {
            return ['type' => 'system', 'model' => $this->table, 'action' => 'update'];
        }

        if ($eventName == 'deleted')
        {
            return ['type' => 'system', 'model' => $this->table, 'action' => 'delete'];
        }

        return '';
    }
}
