<?php

namespace AdrianMejias\OpenAi\Tests\Feature;

use AdrianMejias\OpenAi\Facades\OpenAiFacade as OpenAi;

it('should handle request')->expect(
    fn () => OpenAi::request('GET', '/engines')
)->toBeArray();

it('should handle completions')->expect(
    fn () => OpenAi::completions([
        'prompt' => 'Hello',
        'temperature' => 0.9,
        'max_tokens' => 150,
        'frequency_penalty' => 0,
        'presence_penalty' => 0.6,
    ], 'davinci')
)
    ->toBeArray()
    ->object->toEqual('text_completion')
    ->choices->toBeArray();

it('should handle search')->expect(
    fn () => OpenAi::search([
        'documents' => ['White House', 'hospital', 'school'],
        'query' => 'the president',
    ], 'ada')
)
    ->toBeArray()
    ->object->toEqual('list')
    ->data->toBeArray();

it('should handle answers')->expect(
    fn () => OpenAi::answers([
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
    ])
)
    ->toBeArray()
    ->object->toEqual('answer')
    ->selected_documents->toBeArray();

it('should handle classifications')->expect(
    fn () => OpenAi::classifications([
        'examples' => [
            ['A happy moment', 'Positive'],
            ['I am sad.', 'Negative'],
            ['I am feeling awesome', 'Positive'],
        ],
        'labels' => ['Positive', 'Negative', 'Neutral'],
        'query' => 'It is a raining day',
        'search_model' => 'ada',
        'model' => 'curie',
    ])
)
    ->toBeArray()
    ->object->toEqual('classification')
    ->selected_examples->toBeArray();

it('should handle files')->expect(
    fn () => OpenAi::files(
        dirname(__DIR__, 1) . '/train.jsonl',
        'classifications'
    )
)
    ->toBeArray()
    ->object->toEqual('file');

it('should handle engines')->expect(fn () => OpenAi::engines())
    ->toBeArray()
    ->object->toEqual('list')
    ->data->toBeArray();

it('should handle engine')->expect(fn () => OpenAi::engine('davinci'))
    ->toBeArray()
    ->object->toEqual('engine')
    ->id->toEqual('davinci');
