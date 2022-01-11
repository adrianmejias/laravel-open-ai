<?php

namespace AdrianMejias\OpenAi;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class OpenAiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/openai.php' => config_path('openai.php'),
            ], 'openai');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/openai.php', 'openai');

        $this->app->bind('openai', function ($app) {
            $client = new Client([
                'base_uri' => config('openai.endpoint'),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . config('openai.key'),
                ],
            ]);

            return new OpenAi($client);
        });

        $this->app->singleton(OpenAi::class, OpenAi::class);
        $this->app->alias(OpenAi::class, 'openai');
    }
}
