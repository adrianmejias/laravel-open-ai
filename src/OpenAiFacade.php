<?php

namespace AdrianMejias\OpenAi;

use Illuminate\Support\Facades\Facade;

class OpenAiFacade extends Facade
{
    /** @inheritDoc */
    protected static function getFacadeAccessor(): string
    {
        return 'openai';
    }
}
