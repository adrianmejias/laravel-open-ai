<?php

namespace AdrianMejias\OpenAi\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use AdrianMejias\OpenAi\OpenAiServiceProvider;
use AdrianMejias\OpenAi\OpenAiFacade;

class TestCase extends BaseTestCase
{
    protected $loadEnvironmentVariables = true;

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            OpenAiServiceProvider::class,
        ];
    }

    /**
     * Override application aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'OpenAi' => OpenAiFacade::class,
        ];
    }

    /**
     * Ignore package discovery from.
     *
     * @return array
     */
    public function ignorePackageDiscoveriesFrom()
    {
        return [];
    }
}
