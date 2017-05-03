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
