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

        if (class_exists('Laravel\Ui\UiServiceProvider')) {
            $this->app->register('Laravel\Ui\UiServiceProvider');
        }
    }

    /**
     * Register the package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole() && class_exists(UiCommand::class)) {
            UiCommand::macro('moonlight', function ($command) {
                Moonlight::install($command);
            });
        }
    }
}
