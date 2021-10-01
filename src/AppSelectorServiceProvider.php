<?php

namespace Magnet\AppSelector;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Magnet\AppSelector\Services\AppProvider;
use Magnet\AppSelector\Services\Contracts\AppProviderInterface;

class AppSelectorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/apps.php' => config_path('apps.php'),
        ]);

        $appsService = $this->app->make(AppProviderInterface::class);
        view()->share('apps', $appsService->getApps());

        $this->loadViewsFrom(__DIR__.'/resources/views', 'app-selector');
    }

    public function register()
    {
        $this->app->singleton(AppProviderInterface::class, function($app) {
            return new AppProvider($app->make(Client::class));
        });
    }
}