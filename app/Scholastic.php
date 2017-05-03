<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Components\Activitylog\LogsActivityInterface;
use App\Components\Activitylog\LogsActivity;

class Scholastic extends Model implements LogsActivityInterface
{
    use LogsActivity;
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
