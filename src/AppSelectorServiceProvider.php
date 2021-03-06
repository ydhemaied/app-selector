<?php

namespace Magnet\AppSelector;

use GuzzleHttp\Client;
use Magnet\AppSelector\Support\Selector;
use Illuminate\Support\ServiceProvider;
use Magnet\AppSelector\Services\AppProvider;
use Magnet\AppSelector\Services\Contracts\AppProviderInterface;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class AppSelectorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/apps.php' => config_path('apps.php'),
        ]);

        $this->loadViewsFrom(__DIR__.'/resources/views', 'app-selector');
    }

    public function register()
    {
        $this->app->singleton(AppProviderInterface::class, function($app) {
            return new AppProvider($app->make(Client::class), $app->make(LoggerInterface::class));
        });

        $this->app->bind('selector', function() {
            return new Selector;
        });
    }
}