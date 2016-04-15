<?php namespace WhiteFrame\Dynatable;

use Illuminate\Support\ServiceProvider;
use WhiteFrame\WhiteFrame\WhiteFrame;
use Widget;

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
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'white-frame-dynatable');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'dynatable');
        
        if (wf()) {
            Widget::register('dynatable', \WhiteFrame\Dynatable\Widgets\DynatableWidget::class);
        }
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