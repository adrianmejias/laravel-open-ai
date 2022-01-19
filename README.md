# Laravel Open AI

[![security](https://github.com/adrianmejias/laravel-open-ai/actions/workflows/security.yml/badge.svg)](https://github.com/adrianmejias/laravel-open-ai/actions/workflows/security.yml) [![tests](https://github.com/adrianmejias/laravel-open-ai/actions/workflows/tests.yml/badge.svg)](https://github.com/adrianmejias/laravel-open-ai/actions/workflows/tests.yml) [![PHPStan](https://github.com/adrianmejias/laravel-open-ai/actions/workflows/phpstan.yml/badge.svg)](https://github.com/adrianmejias/laravel-open-ai/actions/workflows/phpstan.yml) [![PHP CS Fixer](https://github.com/adrianmejias/laravel-open-ai/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/adrianmejias/laravel-open-ai/actions/workflows/php-cs-fixer.yml) [![StyleCI](https://github.styleci.io/repos/446770602/shield?branch=main)](https://github.styleci.io/repos/446770602?branch=main) [![Build Status](https://travis-ci.com/adrianmejias/laravel-open-ai.svg?branch=main)](https://travis-ci.com/adrianmejias/laravel-open-ai) [![codecov](https://codecov.io/gh/adrianmejias/laravel-open-ai/branch/main/graph/badge.svg?token=7TCWYB1YV6)](https://codecov.io/gh/adrianmejias/laravel-open-ai) ![Downloads](https://img.shields.io/packagist/dt/adrianmejias/laravel-open-ai) ![Packagist](https://img.shields.io/packagist/v/adrianmejias/laravel-open-ai) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT) ![Liberapay](https://img.shields.io/liberapay/patrons/adrianmejias.svg?logo=liberapay)

[Open AI](https://openai.com/api/) api wrapper for the [Laravel Framework](https://laravel.com/).

## Installation

This version supports PHP 8.0. You can install the package via composer:

`composer require adrianmejias/laravel-open-ai`

To create the `config/open-ai.php` configuration file:

`php artisan vendor:publish --tag=open-ai`

## Usage

### Example

```php
<?php

use OpenAiFacade as OpenAi;

$engines = OpenAi::engines();
```

Expected Output:
```php
$engines = [
    'object' => 'list',
    'data' => [
        [
            'object' => 'engine',
            'id' => 'ada',
            'ready' => 1,
            'owner' => 'openai',
            'created' => '',
            'permissions' => '',
            'replicas' => '',
            'ready_replicas' => '',
            'max_replicas' => '',
        ],
        // ...
    ],
];
```

### Api Requests

- `completions(array $options, string $engine = 'davinci')` - Get a list of completions.
- `search(array $options, string $engine = 'davinci')` - Get a list of search results.
- `answers(array $options)` - Get a list of answers.
- `classifications(array $options)` - Get a list of classifications.
- `files(string $file, string $purpose = 'classifications')` - Publish a training file (jsonl).
- `engines()` - Get a list of engines.
- `engine(string $engine)` - Get information for a specific engine.

## Testing

`composer test`

## Todo

- [x] Add to packagist repo
- [x] Add unit tests
- [x] Add documentation for open source contributations
- [x] Add GitHub Action for unit tests
- [ ] Add more unit test coverages
- [ ] Add more documentation to README.md
- [ ] Add API listing to README.md

## Contributing

Thank you for considering contributing to Laravel Open Ai! You can read the contribution guide [here](.github/CONTRIBUTING.md).

## Code of Conduct

In order to ensure that the community is welcoming to all, please review and abide by the [Code of Conduct](.github/CODE_OF_CONDUCT.md).

## Security Vulnerabilities

Please see the [security file](SECURITY.md) for more information.

## License

The MIT License (MIT). Please see the [license file](LICENSE.md) for more information.
