<?php

namespace AdrianMejias\OpenAi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Open AI Facade
 *
 * @package AdrianMejias\OpenAi\Facades
 * @method static void setClient(HTTPClient $client) Set client instance.
 * @method static array complete(array $options, string $engine = 'davinci')
 * @method static array search(array $options, string $engine = 'davinci')
 * @method static array answer(array $options)
 * @method static array classification(array $options)
 * @method static array engines()
 * @method static array engine(string $engine)
 * @method static array request(string $method, string $uri = '', array $options = [])
 */
class OpenAiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'open-ai';
    }
}
