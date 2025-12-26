<?php

declare(strict_types=1);

use Illuminate\Contracts\Validation\ValidationRule;

arch('rules')
    ->expect('App\Rules')
    ->toExtendNothing()
    ->toImplement(ValidationRule::class)
    ->toOnlyBeUsedIn([
        'App\Http\Controllers',
        'App\Http\Requests',
        'App\Livewire',
    ]);
