<?php

namespace App\Components\Activitylog;

interface LogsActivityInterface
{
    /**
     * Get the message that needs to be logged for the given event.
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getActivityDescriptionForEvent($eventName);

    /**
     * Get the attributes that needs to be logged for the given event.
     *
     * @param string $eventName
     *
     * @return string
     */
    public function getAttributesForLog($eventName);
}
