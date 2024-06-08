<?php

namespace Musta20\LaravelFilter;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelFilterServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'laravelFilter');
        Blade::componentNamespace('Musta20\LaravelFilter\View\Components', 'laravelFilter');

    }

    public function register()
    {
        // Register any bindings or facades here...
    }
}
