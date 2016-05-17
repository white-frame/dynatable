<?php namespace WhiteFrame\Dynatable;

use Illuminate\Support\ServiceProvider;
use WhiteFrame\Helloquent\Repository;
use WhiteFrame\Support\Framework;
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
        Framework::registerPackage('dynatable');
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

        $this->registerRepositoryMacros();
    }

    public function registerRepositoryMacros()
    {
        if(Framework::hasPackage('helloquent')) {
            app()->make('WhiteFrame\Dynatable\Helloquent\RepositoryMacros')->register();
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