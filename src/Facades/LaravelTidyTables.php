<?php

namespace Casperw\LaravelTidyTables\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelTidyTables extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laraveltidytables'; // TODO: Deze class weghalen?
    }
}
