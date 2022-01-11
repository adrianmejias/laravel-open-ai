<?php

namespace AdrianMejias\OpenAi;

use AdrianMejias\OpenAi\Exceptions\OpenAiException;
use Exception;
use GuzzleHttp\Client;

class OpenAi
{
    /**
     * Guzzle client instance.
     *
     * @var Client
     */
    protected $client;

    /**
     * Client instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Set client instance.
     *
     * @return void
     */
    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    /**
     * Complete.
     *
     * @param array $options
     * @param string $engine
     * @return bool|string
     */
    public function complete(array $options, string $engine = 'davinci')
    {
        return $this->request(
            'POST',
            '/engines/' . $engine . '/completions',
            ['json' => $options]
        );
    }

    /**
     * Search.
     *
     * @param array $options
     * @param string $engine
     * @return bool|string
     */
    public function search(array $options, string $engine = 'davinci')
    {
        return $this->request(
            'POST',
            '/engines/' . $engine . '/search',
            ['json' => $options]
        );
    }

    /**
     * Answer.
     *
     * @param array $options
     * @return bool|string
     */
    public function answer(array $options)
    {
        return $this->request('POST', '/answers', ['json' => $options]);
    }

    /**
     * Classiciation.
     *
     * @param array $options
     * @return bool|string
     */
    public function classification(array $options)
    {
        return $this->request(
            'POST',
            '/classifications',
            ['json' => $options]
        );
    }

    /**
     * Engines.
     *
     * @return bool|string
     */
    public function engines()
    {
        return $this->request('GET', '/engines');
    }

    /**
     * Engine.
     *
     * @param string $engine
     * @return bool|string
     */
    public function engine(string $engine)
    {
        return $this->request('GET', '/engines/' . $engine);
    }

    /**
     * Send request to OpenAi api.
     *
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return array
     */
    public function request(
        string $method,
        string $uri = '',
        array $options = []
    ) {
        $uri = '/' . config('openai.version', 'v1') . $uri;

        try {
            $response = $this->client->request($method, $uri, $options);
        } catch (Exception $e) {
            throw new OpenAiException(
                'Could not get valid response from api.',
                100,
                $e
            );
        }

        try {
            $contents = (string) $response->getBody();
        } catch (Exception $e) {
            throw new OpenAiException(
                'Could not get valid body response from api.',
                101,
                $e
            );
        }

        if ($contents && ($json = json_decode($contents, true))) {
            return $json ?? [];
        }

        return [];
    }
}
