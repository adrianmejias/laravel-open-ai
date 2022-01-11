<?php

namespace AdrianMejias\OpenAi\Exceptions;

use Exception;
use Throwable;

class OpenAiException extends Exception
{
    /**
     * Open AI Exception constructor.
     *
     * @param  null|string  $message
     * @param  int  $code
     * @param  null|Throwable  $previous
     */
    public function __construct(
        ?string $message = null,
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct(
            $message ?? 'Something went wrong.',
            $code,
            $previous
        );
    }
}
