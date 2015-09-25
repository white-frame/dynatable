<?php namespace Ifnot\Dynatable;

use Illuminate\Support\ServiceProvider;

/**
 * Class DynatableServiceProvider
 * @package Ifnot\Dynatable
 */
class DynatableServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;


	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind('dynatable', 'Ifnot\Dynatable\Dynatable');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
