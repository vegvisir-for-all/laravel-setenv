<?php

/*
 * This file is part of the vegvisir/setenv package.
 * SetEnv is a simple package to manipulate .env variables progamatically
 * @copyright 2019 Vegvisir Sp. z o.o. <vegvisir.for.all@gmail.com>
 * @license MIT License
 */

namespace Vegvisir\SetEnv\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;

/**
 * @internal
 * @coversNothing
 */
class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        // make sure, our .env file is loaded
        // copy(__DIR__.'/../.env', $this->getVendorPath().'/orchestra/testbench-core/laravel/.env');
        if (file_exists(__DIR__.'/../vendor/orchestra/testbench-core/laravel/.env')) {
            unlink(__DIR__.'/../vendor/orchestra/testbench-core/laravel/.env');
        }
        $f = fopen(__DIR__.'/../vendor/orchestra/testbench-core/laravel/.env', 'w+');
        fwrite($f, "TESTS=true\n");
        fclose($f);
        parent::setUp();
    }

    protected function getEnvironmentSetUp($app)
    {
        // make sure, our .env file is loaded
        $app->useEnvironmentPath(__DIR__.'/../vendor/orchestra/testbench-core/laravel/');
        parent::getEnvironmentSetUp($app);
    }
}
