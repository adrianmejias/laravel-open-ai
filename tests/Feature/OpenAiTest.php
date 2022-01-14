<?php

use AdrianMejias\OpenAi\Facades\OpenAiFacade as OpenAi;

it('should handle request')->expect(
    fn () => OpenAi::request('GET', '/engines')
)->toBeArray();

// it('should handle request', function () {
//     $result = OpenAi::request('GET', '/engines');
//     expect($result)->toBeArray();
// });

// it('should handle simple completion', function () {
//     $result = OpenAi::complete([
//         'prompt' => 'Hello',
//         'temperature' => 0.9,
//         'max_tokens' => 150,
//         'frequency_penalty' => 0,
//         'presence_penalty' => 0.6,
//     ], 'davinci');

//     $this->assertIsArray($result);
//     $this->assertArrayHasKey('object', $result);
//     $this->assertSame('text_completion', $result['object']);
//     $this->assertArrayHasKey('choices', $result);
//     $this->assertIsArray($result['choices']);
// });

// it('should handle search', function () {
//     $result = OpenAi::search([
//         'documents' => ['White House', 'hospital', 'school'],
//         'query' => 'the president',
//     ], 'ada');

//     $this->assertIsArray($result);
//     $this->assertArrayHasKey('object', $result);
//     $this->assertSame('list', $result['object']);
//     $this->assertArrayHasKey('data', $result);
//     $this->assertIsArray($result['data']);
// });

// it('should handle answers', function () {
//     $result = OpenAi::answer([
//         'documents' => ['Puppy A is happy.', 'Puppy B is sad.'],
//         'question' => 'which puppy is happy?',
//         'search_model' => 'ada',
//         'model' => 'curie',
//         'examples_context' => 'In 2017, U.S. life expectancy was 78.6 years.',
//         'examples' => [
//             [
//                 'What is human life expectancy in the United States?',
//                 '78 years.',
//             ],
//         ],
//         'max_tokens' => 5,
//         'stop' => ["\n", '<|endoftext|>'],
//     ]);

//     $this->assertIsArray($result);
//     $this->assertArrayHasKey('object', $result);
//     $this->assertSame('answer', $result['object']);
//     $this->assertArrayHasKey('selected_documents', $result);
//     $this->assertIsArray($result['selected_documents']);
// });

// it('should handle classification', function () {
//     $result = OpenAi::classification([
//         'examples' => [
//             ['A happy moment', 'Positive'],
//             ['I am sad.', 'Negative'],
//             ['I am feeling awesome', 'Positive'],
//         ],
//         'labels' => ['Positive', 'Negative', 'Neutral'],
//         'query' => 'It is a raining day =>(',
//         'search_model' => 'ada',
//         'model' => 'curie',
//     ]);

//     $this->assertIsArray($result);
//     $this->assertArrayHasKey('object', $result);
//     $this->assertSame('classification', $result['object']);
//     $this->assertArrayHasKey('selected_examples', $result);
//     $this->assertIsArray($result['selected_examples']);
// });

// it('should handle engines', function () {
//     $result = OpenAi::engines();

//     $this->assertIsArray($result);
//     $this->assertArrayHasKey('object', $result);
//     $this->assertSame('list', $result['object']);
//     $this->assertArrayHasKey('data', $result);
//     $this->assertIsArray($result['data']);
// });

// it('should handle engine', function () {
//     $engine = 'davinci';
//     $result = OpenAi::engine($engine);

//     $this->assertIsArray($result);
//     $this->assertArrayHasKey('object', $result);
//     $this->assertSame('engine', $result['object']);
//     $this->assertArrayHasKey('id', $result);
//     $this->assertSame($engine, $result['id']);
// });
