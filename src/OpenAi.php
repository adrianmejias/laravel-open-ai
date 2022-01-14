<?php

namespace AdrianMejias\OpenAi;

use AdrianMejias\OpenAi\Contracts\OpenAiContract;
use AdrianMejias\OpenAi\Exceptions\OpenAiException;
use Illuminate\Support\Facades\Http;

/**
 * Open AI
 *
 * @package AdrianMejias\OpenAi
 */
class OpenAi implements OpenAiContract
{
    /**
     * Client instance.
     *
     * @return void
     * @throws OpenAiException
     */
    public function __construct()
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
    }

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
    ): array {
        return $this->request(
            'post',
            '/engines/' . $engine . '/completions',
            $options
        );
    }

    /**
     * Search.
     *
     * @param array|string[] $options
     * @param string $engine
     * @return mixed
     * @throws OpenAiException
     */
    public function search(array $options, string $engine = 'davinci'): array
    {
        return $this->request(
            'post',
            '/engines/' . $engine . '/search',
            $options
        );
    }

    /**
     * Answers.
     *
     * @param array|string[] $options
     * @return mixed
     * @throws OpenAiException
     */
    public function answers(array $options): array
    {
        return $this->request('post', '/answers', $options);
    }

    /**
     * Classiciations.
     *
     * @param array|string[] $options
     * @return mixed
     * @throws OpenAiException
     */
    public function classifications(array $options): array
    {
        return $this->request('post', '/classifications', $options);
    }

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
    ) {
        if (!file_exists($file)) {
            throw new OpenAiException(
                'File does not exist at path ' . $file,
                103
            );
        }

        $options = [
            'name' => 'file',
            'contents' => file_get_contents($file),
            'filename' => basename($file),
            'purpose' => $purpose,
        ];

        return $this->request('post', '/files', $options);
    }

    /**
     * Engines.
     *
     * @return mixed
     * @throws OpenAiException
     */
    public function engines(): array
    {
        return $this->request('get', '/engines');
    }

    /**
     * Engine.
     *
     * @param string $engine
     * @return mixed
     * @throws OpenAiException
     */
    public function engine(string $engine): array
    {
        return $this->request('get', '/engines/' . $engine);
    }

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
    ) {
        $baseUri = 'https://' . config('open-ai.endpoint', 'api.openai.com');
        $path = rtrim(
            config('open-ai.version', 'v1') . '/' . ltrim($uri, '/'),
            '/'
        );
        $uri = $baseUri . '/' . $path;

        if (isset($options['name']) && $options['name'] === 'file') {
            $name = $options['name'];
            $contents = $options['contents'];
            $filename = $options['filename'];
            $response = Http::acceptJson()
                ->withToken(config('open-ai.key'))
                ->attach(
                    $name,
                    $contents,
                    $filename
                )
                ->post($uri, [
                    'purpose' => $options['purpose'] ?? 'classifications',
                ]);
        } elseif ($method === 'post') {
            $response = Http::acceptJson()
                ->withToken(config('open-ai.key'))
                ->post($uri, $options);
        } else {
            $response = Http::acceptJson()
                ->withToken(config('open-ai.key'))
                ->get($uri, $options);
        }

        // @todo fix phpdoc

        return $response->throw(fn ($response, $e) => throw new OpenAiException(
            $e->getMessage(),
            $e->getCode(),
            $e->getPrevious(),
        ))->json(null, []);
    }
}
