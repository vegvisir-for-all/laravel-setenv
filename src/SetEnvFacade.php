<?php

/*
 * This file is part of the vegvisir/setenv package.
 * SetEnv is a simple package to manipulate .env variables progamatically
 * @copyright 2019 Vegvisir Sp. z o.o. <vegvisir.for.all@gmail.com>
 * @license MIT License
 */

namespace Vegvisir\SetEnv;

use Illuminate\Support\Facades\Facade;

class SetEnvFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'setenv';
    }
}
