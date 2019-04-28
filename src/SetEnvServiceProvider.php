<?php

/*
 * This file is part of the vegvisir/setenv package.
 * SetEnv is a simple package to manipulate .env variables progamatically
 * @copyright 2019 Vegvisir Sp. z o.o. <vegvisir.for.all@gmail.com>
 * @license MIT License
 */

namespace Vegvisir\SetEnv;

use Illuminate\Support\ServiceProvider;

class SetEnvServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind('setenv', function ($app) {
            return new SetEnv($app);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }
}
