<?php

namespace Musta20\LaravelRecordsFilter;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelRecordsFilterServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'laravelRecordsFilter');

        Blade::componentNamespace('Musta20\LaravelRecordsFilter\View\Components', 'laravelRecordsFilter');

        $this->loadTranslationsFrom(__DIR__ . '/lang', 'laravelRecordsFilter');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/resources/views' => $this->app->resourcePath('views/vendor/laravelRecordsFilter'),
            ], 'laravel-Records-Filter');
        }

    }

    public function register()
    {
        // Register any bindings or facades here...
    }
}
