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

        $this->client = $client ?? new HTTPClient([
            'base_uri' => config('open-ai.endpoint', 'api.openai.com'),
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
        $uri = '/' . config('open-ai.version', 'v1') . $uri;

        try {
            $response = $this->client->request($method, $uri, $options);
        } catch (Exception $e) {
            throw new OpenAiException(
                'Could not get valid response from api.',
                103,
                $e
            );
        }

        try {
            $contents = (string) $response->getBody();
        } catch (Exception $e) {
            throw new OpenAiException(
                'Could not get valid body response from api.',
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
