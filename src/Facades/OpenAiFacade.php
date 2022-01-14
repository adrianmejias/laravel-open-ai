<?php

namespace AdrianMejias\OpenAi\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Open AI Facade
 *
 * @package AdrianMejias\OpenAi\Facades
 * @method static array completions(array $options, string $engine = 'davinci')
 * @method static array search(array $options, string $engine = 'davinci')
 * @method static array answers(array $options)
 * @method static array classifications(array $options)
 * @method static array files(string $file, string $purpose = 'classifications')
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
