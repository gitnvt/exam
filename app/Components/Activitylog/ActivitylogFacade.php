<?php

namespace App\Components\Activitylog;

use Illuminate\Support\Facades\Facade;

class ActivitylogFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'activity';
    }
}
