<?php

namespace AdrianMejias\OpenAi\Tests\Unit;

use AdrianMejias\OpenAi\Facades\OpenAiFacade as OpenAi;

it('should handle mock request', function () {
    $method = 'GET';
    $uri = '/engines';
    OpenAi::shouldReceive('request')->once()
        ->with($method, $uri)->andReturn([]);

    $result = OpenAi::request($method, $uri);
    expect($result)->toBeArray();
});

it('should handle mock completions', function () {
    $options = [
        'prompt' => 'Hello',
        'temperature' => 0.9,
        'max_tokens' => 150,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
    ];
    $engine = 'davinci';
    OpenAi::shouldReceive('completions')->once()
        ->with($options, $engine)->andReturn([]);

    $result = OpenAi::completions($options, $engine);
    expect($result)->toBeArray();
});

it('should handle mock search', function () {
    $options = [
        'documents' => ['White House', 'hospital', 'school'],
        'query' => 'the president',
    ];
    $engine = 'ada';
    OpenAi::shouldReceive('search')->once()
        ->with($options, $engine)->andReturn([]);

    $result = OpenAi::search($options, $engine);
    expect($result)->toBeArray();
});

it('should handle mock answers', function () {
    $options = [
        'documents' => ['Puppy A is happy.', 'Puppy B is sad.'],
        'question' => 'which puppy is happy?',
        'search_model' => 'ada',
        'model' => 'curie',
        'examples_context' => 'In 2017, U.S. life expectancy was 78.6 years.',
        'examples' => [
            [
                'What is human life expectancy in the United States?',
                '78 years.',
            ],
        ],
        'max_tokens' => 5,
        'stop' => ["\n", '<|endoftext|>'],
    ];
    OpenAi::shouldReceive('answers')->once()
        ->with($options)->andReturn([]);

    $result = OpenAi::answers($options);
    expect($result)->toBeArray();
});

it('should handle mock classifications', function () {
    $options = [
        'examples' => [
            ['A happy moment', 'Positive'],
            ['I am sad.', 'Negative'],
            ['I am feeling awesome', 'Positive'],
        ],
        'labels' => ['Positive', 'Negative', 'Neutral'],
        'query' => 'It is a raining day =>(',
        'search_model' => 'ada',
        'model' => 'curie',
    ];
    OpenAi::shouldReceive('classifications')->once()
        ->with($options)->andReturn([]);

    $result = OpenAi::classifications($options);
    expect($result)->toBeArray();
});

it('should handle mock files', function () {
    $file = dirname(__DIR__, 1) . '/train.jsonl';
    $purpose = 'classifications';
    OpenAi::shouldReceive('files')->once()
        ->with($file, $purpose)->andReturn([]);

    $result = OpenAi::files($file, $purpose);
    expect($result)->toBeArray();
});

it('should handle mock engines', function () {
    OpenAi::shouldReceive('engines')->once()->andReturn([]);

    $result = OpenAi::engines();
    expect($result)->toBeArray();
});

it('should handle mock engine', function () {
    $engine = 'davinci';
    OpenAi::shouldReceive('engine')->once()->with($engine)->andReturn([]);

    $result = OpenAi::engine($engine);
    expect($result)->toBeArray();
});
