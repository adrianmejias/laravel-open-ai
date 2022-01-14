<?php

namespace AdrianMejias\OpenAi\Contracts;

use AdrianMejias\OpenAi\Exceptions\OpenAiException;
use GuzzleHttp\Client as HTTPClient;

/**
 * Open AI Contract
 *
 * @package AdrianMejias\OpenAi\Contracts
 */
interface OpenAiContract
{
    /**
     * Client instance.
     *
     * @param null|HTTPClient $client
     * @return void
     * @throws OpenAiException
     */
    public function __construct(?HTTPClient $client = null);

    /**
     * Set client instance.
     *
     * @param HTTPClient $client
     * @return void
     */
    public function setClient(HTTPClient $client): void;

    /**
     * Complete.
     *
     * @param array $options
     * @param string $engine
     * @return array
     * @throws OpenAiException
     */
    public function complete(array $options, string $engine = 'davinci'): array;

    /**
     * Search.
     *
     * @param array $options
     * @param string $engine
     * @return array
     * @throws OpenAiException
     */
    public function search(array $options, string $engine = 'davinci'): array;

    /**
     * Answer.
     *
     * @param array $options
     * @return array
     * @throws OpenAiException
     */
    public function answer(array $options): array;

    /**
     * Classiciation.
     *
     * @param array $options
     * @return array
     * @throws OpenAiException
     */
    public function classification(array $options): array;

    /**
     * Engines.
     *
     * @return array
     * @throws OpenAiException
     */
    public function engines(): array;

    /**
     * Engine.
     *
     * @param string $engine
     * @return array
     * @throws OpenAiException
     */
    public function engine(string $engine): array;

    /**
     * Send request to OpenAi api.
     *
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array
     * @throws OpenAiException
     */
    public function request(
        string $method,
        string $uri = '',
        array $options = []
    ): array;
}
