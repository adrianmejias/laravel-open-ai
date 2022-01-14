<?php

namespace AdrianMejias\OpenAi;

use Illuminate\Support\ServiceProvider;

/**
 * Open AI Service Provider
 *
 * @package AdrianMejias\OpenAi
 */
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
                __DIR__ . '/../config/open-ai.php' => config_path('open-ai.php'),
            ], 'open-ai');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/open-ai.php', 'open-ai');

        $this->app->bind('open-ai', fn ($app) => new OpenAi());
        $this->app->singleton(OpenAi::class);
        $this->app->alias(OpenAi::class, 'open-ai');
    }
}
