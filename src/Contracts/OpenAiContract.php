<?php

namespace AdrianMejias\OpenAi\Contracts;

use AdrianMejias\OpenAi\Exceptions\OpenAiException;

/**
 * Open AI Contract
 *
 * @package AdrianMejias\OpenAi\Contracts
 */
interface OpenAiContract
{
    /**
     * Completions.
     *
     * @param array|string[] $options
     * @param string $engine
     * @return mixed
     * @throws OpenAiException
     */
    public function completions(
        array $options,
        string $engine = 'davinci'
    );

    /**
     * Search.
     *
     * @param array|string[] $options
     * @param string $engine
     * @return mixed
     * @throws OpenAiException
     */
    public function search(array $options, string $engine = 'davinci');

    /**
     * Answers.
     *
     * @param array|string[] $options
     * @return mixed
     * @throws OpenAiException
     */
    public function answers(array $options);

    /**
     * Classiciations.
     *
     * @param array|string[] $options
     * @return mixed
     * @throws OpenAiException
     */
    public function classifications(array $options);

    /**
     * Files.
     *
     * @param string $file
     * @param string $purpose Defaults to classifications.
     * @return mixed
     * @throws OpenAiException
     */
    public function files(
        string $file,
        string $purpose = 'classifications'
    );

    /**
     * Engines.
     *
     * @return mixed
     * @throws OpenAiException
     */
    public function engines();

    /**
     * Engine.
     *
     * @param string $engine
     * @return mixed
     * @throws OpenAiException
     */
    public function engine(string $engine);

    /**
     * Send request to OpenAi api.
     *
     * @param string $method Default is get.
     * @param string $uri Default is /.
     * @param array|string[] $options
     * @return mixed
     * @throws OpenAiException
     */
    public function request(
        string $method = 'get',
        string $uri = '/',
        array $options = []
    );
}
