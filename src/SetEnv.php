<?php

/*
 * This file is part of the vegvisir/setenv package.
 * SetEnv is a simple package to manipulate .env variables progamatically
 * @copyright 2019 Vegvisir Sp. z o.o. <vegvisir.for.all@gmail.com>
 * @license MIT License
 */

namespace Vegvisir\SetEnv;

use Illuminate\Foundation\Application;

class SetEnv
{
    /**
     *  App container.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Class constructor.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Set new or override existing .env value.
     *
     * @param string $key
     * @param string $value
     *
     * @return bool
     */
    public function set($key, $value): bool
    {
        if (false !== strpos($value, ' ')) {
            $value = "'${value}'";
        }

        $envFilePath = $this->app->environmentFilePath();
        $contents = file_get_contents($envFilePath);

        if ($oldValue = $this->getOldValue($contents, $key)) {
            $contents = str_replace("{$key}={$oldValue}", "{$key}={$value}", $contents);
            $this->writeFile($envFilePath, $contents);
        } else {
            $contents = $contents."\n{$key}={$value}\n";
            $this->writeFile($envFilePath, $contents);
        }

        $contents = file_get_contents($envFilePath);

        if ($this->getOldValue($contents, $key) !== $value) {
            throw new \Exception();
        }

        return true;
    }

    /**
     * Overwrite the contents of a file.
     *
     * @param string $path
     * @param string $contents
     *
     * @return bool
     */
    protected function writeFile(string $path, string $contents): bool
    {
        $file = fopen($path, 'w');
        fwrite($file, $contents);

        return fclose($file);
    }

    /**
     * Get the old value of a given key from an environment file.
     *
     * @param string $envFile
     * @param string $key
     *
     * @return string
     */
    protected function getOldValue(string $envFile, string $key): string
    {
        // Match the given key at the beginning of a line
        preg_match("/^{$key}=[^\r\n]*/m", $envFile, $matches);
        if (\count($matches)) {
            return substr($matches[0], \strlen($key) + 1);
        }

        return '';
    }
}
