<?php namespace WhiteFrame\Dynatable;

use Illuminate\Support\ServiceProvider;
use Pingpong\Widget\WidgetFacade as Widget;

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

    public function boot()
    {
        // $widgets = $this->app->make('\Pingpong\Widget\Widget');
        // $widgets->register('dynatable', \WhiteFrame\Dynatable\Widgets\DynatableWidget::class);
        Widget::register('dynatable', \WhiteFrame\Dynatable\Widgets\DynatableWidget::class);
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