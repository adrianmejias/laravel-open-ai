<?php

namespace AdrianMejias\OpenAi;

use AdrianMejias\OpenAi\Contracts\OpenAiContract;
use AdrianMejias\OpenAi\Exceptions\OpenAiException;
use Exception;
use GuzzleHttp\Client as HTTPClient;

/**
 * Open AI
 *
 * @package AdrianMejias\OpenAi
 */
class OpenAi implements OpenAiContract
{
    /**
     * Guzzle client instance.
     *
     * @var HTTPClient
     */
    protected $client;

    /** @inheritDoc */
    public function __construct(?HTTPClient $client = null)
    {
        if (empty(config('open-ai.key'))) {
            throw new OpenAiException(
                'Could not get valid api key from config.',
                100
            );
        }

        if (empty(config('open-ai.endpoint', 'api.openai.com'))) {
            throw new OpenAiException(
                'Could not get valid endpoint from config.',
                101
            );
        }

        if (empty(config('open-ai.version', 'v1'))) {
            throw new OpenAiException(
                'Could not get valid version from config.',
                102
            );
        }

        $baseUri = 'https://' . config('open-ai.endpoint', 'api.openai.com');
        $this->client = $client ?? new HTTPClient([
            'base_uri' => $baseUri,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . config('open-ai.key'),
            ],
        ]);
    }

    /** @inheritDoc */
    public function setClient(HTTPClient $client): void
    {
        $this->client = $client;
    }

    /** @inheritDoc */
    public function complete(array $options, string $engine = 'davinci'): array
    {
        return $this->request(
            'POST',
            '/engines/' . $engine . '/completions',
            ['json' => $options]
        );
    }

    /** @inheritDoc */
    public function search(array $options, string $engine = 'davinci'): array
    {
        return $this->request(
            'POST',
            '/engines/' . $engine . '/search',
            ['json' => $options]
        );
    }

    /** @inheritDoc */
    public function answer(array $options): array
    {
        return $this->request('POST', '/answers', ['json' => $options]);
    }

    /** @inheritDoc */
    public function classification(array $options): array
    {
        return $this->request(
            'POST',
            '/classifications',
            ['json' => $options]
        );
    }

    /** @inheritDoc */
    public function engines(): array
    {
        return $this->request('GET', '/engines');
    }

    /** @inheritDoc */
    public function engine(string $engine): array
    {
        return $this->request('GET', '/engines/' . $engine);
    }

    /** @inheritDoc */
    public function request(
        string $method,
        string $uri = '',
        array $options = []
    ): array {
        $uri = rtrim(
            config('open-ai.version', 'v1') . '/' . ltrim($uri, '/'),
            '/'
        );
        $baseUri = 'https://' . config('open-ai.endpoint', 'api.openai.com');
        $options = array_merge([
            'base_uri' => $baseUri,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . config('open-ai.key'),
            ],
        ], $options);

        try {
            $response = $this->client->request($method, $uri, $options);
        } catch (Exception $e) {
            throw new OpenAiException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
        }

        if ($response->getStatusCode() != 200) {
            throw new OpenAiException(
                'Could not get valid status code response from api endpoint.',
                103
            );
        }

        try {
            $contents = (string) $response->getBody();
        } catch (Exception $e) {
            throw new OpenAiException(
                'Could not get valid body response from api endpoint.',
                104,
                $e
            );
        }

        if ($contents && ($json = json_decode($contents, true))) {
            return $json ?? [];
        }

        return [];
    }
}
