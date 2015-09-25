<?php namespace Ifnot\Dynatable\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Class Dynatable
 * @package Ifnot\Dynatable\Facade
 */
class Dynatable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dynatable';
    }

}