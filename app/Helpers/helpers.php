<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

if (! function_exists('get_models')) {
    /**
     * @return list<class-string<Model>>
     */
    function get_models(): array
    {
        $models = glob(__DIR__.'/../Models/*.php');

        return collect($models)
            ->map(fn (string $file): string => 'App\Models\\'.basename($file, '.php'))
            ->all();
    }
}

if (! function_exists('user')) {
    function user(): ?User
    {
        /** @var User|null */
        return auth()->user();
    }
}
