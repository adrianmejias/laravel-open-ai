<?php

namespace AdrianMejias\OpenAi\Tests;

use AdrianMejias\OpenAi\OpenAiFacade;
use AdrianMejias\OpenAi\OpenAiServiceProvider;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as BaseTestCase;

/** @inheritDoc */
class TestCase extends BaseTestCase
{
    /** @inheritDoc */
    protected $loadEnvironmentVariables = true;

    /** @inheritDoc */
    protected function getPackageProviders($app): array
    {
        return [
            OpenAiServiceProvider::class,
        ];
    }

    /** @inheritDoc */
    protected function getPackageAliases($app): array
    {
        return [
            'OpenAi' => OpenAiFacade::class,
            'Http' => Http::class,
        ];
    }

    /** @inheritDoc */
    public function ignorePackageDiscoveriesFrom(): array
    {
        return [];
    }
}
