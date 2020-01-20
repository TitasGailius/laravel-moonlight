<?php

namespace TitasGailius\Moonlight;

use Laravel\Ui\UiCommand;
use Illuminate\Support\ServiceProvider;

class MoonlightServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (class_exists('App\Providers\InertiaServiceProvider')) {
            $this->app->register('App\Providers\InertiaServiceProvider');
        }
    }

    /**
     * Register the package services.
     *
     * @return void
     */
    public function boot()
    {
        UiCommand::macro('moonlight', function ($command) {
            Moonlight::install($command);
        });
    }
}
