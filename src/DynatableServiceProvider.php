<?php namespace WhiteFrame\Dynatable;

use Illuminate\Support\ServiceProvider;

/**
 * Class DynatableServiceProvider
 * @package WhiteFrame\Dynatable
 */
class DynatableServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     */
    public function register()
    {

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}