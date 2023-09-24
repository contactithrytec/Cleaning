<?php

namespace App\Providers\CustomProviders;

use Illuminate\Support\ServiceProvider;

class RolesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      $this->loadViewsFrom(__DIR__.'/../Views');
    }
}
