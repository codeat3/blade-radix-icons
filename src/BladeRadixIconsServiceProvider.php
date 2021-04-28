<?php

declare(strict_types=1);

namespace Codeat3\BladeRadixIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class BladeRadixIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            $factory->add('radix-icons', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'radix',
            ]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-radix-icons'),
            ], 'blade-radix-icons');
        }
    }
}
