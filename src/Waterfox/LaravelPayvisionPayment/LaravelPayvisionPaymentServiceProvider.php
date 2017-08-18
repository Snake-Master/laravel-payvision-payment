<?php namespace Waterfox\LaravelPayvisionPayment;

use Illuminate\Support\ServiceProvider;
use Waterfox\Payvision\Payvision;

class LaravelPayvisionPaymentServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('waterfox/laravel-payvision-payment');
        include(realpath(__DIR__ . '/../').'/helper.php');
        define('CONFIG_PREFIX', 'laravel-payvision-payment::config.');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
        app()->bind('payvision', function ($app) {
            return app(Payvision::class);
        });
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
