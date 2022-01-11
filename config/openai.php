<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Open AI Configurations
    |--------------------------------------------------------------------------
    |
    */

    'key' => env('OPENAI_KEY'),
    'endpoint' => env('OPENAI_ENDPOINT', 'api.openai.com'),
    'version' => env('OPENAI_VERSION', 'v1'),

];
