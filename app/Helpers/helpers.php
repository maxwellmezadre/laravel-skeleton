<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

if (! function_exists('creates_application')) {
    function creates_application(): Application
    {
        require __DIR__.'/../../vendor/autoload.php';

        /** @var Application $app */
        $app = require __DIR__.'/../../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        restore_error_handler();
        restore_exception_handler();

        return $app;
    }
}

if (! function_exists('get_models')) {
    function get_models(): array
    {
        $models = glob(__DIR__.'/../../app/Models/*.php');

        return collect($models)
            ->map(fn (string $file): string => 'App\Models\\'.basename($file, '.php'))
            ->toArray();
    }
}

if (! function_exists('user')) {
    function user(): ?User
    {
        if (auth()->check()) {
            return auth()->user();
        }

        return null;
    }
}
