<?php

namespace BunoWave\ReCloud;

use BunoWave\ReCloud\View\Components\Widget;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ReCloudServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/recloud.php', 'recloud');

        $this->app->singleton(Client::class, fn ($app) => new Client((array) $app['config']->get('recloud')));
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'recloud');

        Blade::component(Widget::class, 'recloud');

        Validator::extend('recloud', function ($attribute, $value) {
            return app(Client::class)->verify(is_string($value) ? $value : '', request()->ip())->success;
        }, 'Verification failed. Please try again.');

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config/recloud.php' => config_path('recloud.php')], 'recloud-config');
        }
    }
}
