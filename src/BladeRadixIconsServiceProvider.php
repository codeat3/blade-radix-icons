<?php

declare(strict_types=1);

namespace Codeat3\BladeRadixIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Container\Container;

final class BladeRadixIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-radix-icons', []);

            $factory->add('radix-icons', array_merge(['path' => __DIR__.'/../resources/svg'], $config));
        });

    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blade-radix-icons.php', 'blade-radix-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-radix-icons'),
            ], 'blade-radix-icons');

            $this->publishes([
                __DIR__.'/../config/blade-radix-icons.php' => $this->app->configPath('blade-radix-icons.php'),
            ], 'blade-radix-icons-config');
        }
    }
}
