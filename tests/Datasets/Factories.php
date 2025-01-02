<?php

declare(strict_types=1);

dataset('factories', function () {
    $factories = glob(__DIR__.'/../../database/factories/*.php');

    return collect($factories)
        ->map(fn (string $file): string => 'Database\Factories\\'.basename($file, '.php'))
        ->toArray();
});
