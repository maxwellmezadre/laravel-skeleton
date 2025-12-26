<?php

declare(strict_types=1);

use Illuminate\View\Component;

arch('views')
    ->expect('App\View\Components')
    ->toExtend(Component::class)
    ->toHaveMethod('render')
    ->not->toBeUsed();
