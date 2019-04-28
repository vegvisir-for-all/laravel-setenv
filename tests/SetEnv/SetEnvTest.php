<?php

/*
 * This file is part of the vegvisir/setenv package.
 * SetEnv is a simple package to manipulate .env variables progamatically
 * @copyright 2019 Vegvisir Sp. z o.o. <vegvisir.for.all@gmail.com>
 * @license MIT License
 */

namespace Vegvisir\SetEnv\Tests\SetEnv;

use Vegvisir\SetEnv\Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class SetEnvTest extends TestCase
{
    public function testCreateWithoutSpaces()
    {
        $setEnv = app()->make('Vegvisir\SetEnv\SetEnv');
        $setEnv->set('TEST_ONE', 'one');
        $setEnv->set('TEST_TWO', 'two');
        $dotenv = \Dotenv\Dotenv::create(app()->environmentPath());
        $dotenv->load();
        $this->assertSame(getenv('TEST_ONE'), 'one');
        $this->assertSame(getenv('TEST_TWO'), 'two');
    }

    public function testCreateWithSpaces()
    {
        $setEnv = app()->make('Vegvisir\SetEnv\SetEnv');
        $setEnv->set('TEST_SPACES_ONE', 'test one');
        $setEnv->set('TEST_SPACES_TWO', 'test two');
        $dotenv = \Dotenv\Dotenv::create(app()->environmentPath());
        $dotenv->load();
        $this->assertSame(getenv('TEST_SPACES_ONE'), 'test one');
        $this->assertSame(getenv('TEST_SPACES_TWO'), 'test two');
    }

    public function testUpdateWithoutSpaces()
    {
        $setEnv = app()->make('Vegvisir\SetEnv\SetEnv');
        $setEnv->set('TEST_ONE', 'oneupd');
        $setEnv->set('TEST_TWO', 'twoupd');
        $dotenv = \Dotenv\Dotenv::create(app()->environmentPath());
        $dotenv->load();
        $this->assertSame(getenv('TEST_ONE'), 'oneupd');
        $this->assertSame(getenv('TEST_TWO'), 'twoupd');
    }

    public function testUpdateWithSpaces()
    {
        $setEnv = app()->make('Vegvisir\SetEnv\SetEnv');
        $setEnv->set('TEST_ONE', 'test one now with spaces');
        $setEnv->set('TEST_SPACES_ONE', 'test one updated');
        $dotenv = \Dotenv\Dotenv::create(app()->environmentPath());
        $dotenv->load();
        $this->assertSame(getenv('TEST_ONE'), 'test one now with spaces');
        $this->assertSame(getenv('TEST_SPACES_ONE'), 'test one updated');
    }
}
