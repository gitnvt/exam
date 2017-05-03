<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Components\Activitylog\LogsActivityInterface;
use App\Components\Activitylog\LogsActivity;

class Subjects extends Model implements LogsActivityInterface
{
    use LogsActivity;
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
                'title' => ('Created ' . $this->name),
            ]);
        }

        if ($eventName == 'updated')
        {
            return json_encode([
                'title' => ('Updated ' . $this->name),
            ]);
        }

        if ($eventName == 'deleted')
        {
            return json_encode([
                'title' => ('Deleted ' . $this->name),
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
