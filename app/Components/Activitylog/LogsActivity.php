<?php

namespace App\Components\Activitylog;

use Activity;

trait LogsActivity
{
    protected static function bootLogsActivity()
    {
        foreach (static::getRecordActivityEvents() as $eventName) {
            static::$eventName(function (LogsActivityInterface $model) use ($eventName) {

                $message = $model->getActivityDescriptionForEvent($eventName);
                $attributes = $model->getAttributesForLog($eventName);

                if ($message != '') {
                    Activity::log($message, '', $attributes);
                }
            });
        }
    }

    /**
     * Set the default events to be recorded if the $recordEvents
     * property does not exist on the model.
     *
     * @return array
     */
    protected static function getRecordActivityEvents()
    {
        if (isset(static::$recordEvents)) {
            return static::$recordEvents;
        }

        return [
            'created', 'updated', 'deleting', 'deleted',
        ];
    }
}
