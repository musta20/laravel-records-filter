<?php

namespace Musta20\LaravelRecordsFilter;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelRecordsFilterServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'laravelRecordsFilter');

        $this->loadJsonTranslationsFrom(__DIR__ . '/lang');

        Blade::componentNamespace('Musta20\LaravelRecordsFilter\View\Components', 'laravelRecordsFilter');

    }

    public function register()
    {
        // Register any bindings or facades here...
    }
}
