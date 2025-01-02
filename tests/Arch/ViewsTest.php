<?php

declare(strict_types=1);

arch('views')
    ->expect('App\View\Components')
    ->toExtend(Illuminate\View\Component::class)
    ->toHaveMethod('render')
    ->not->toBeUsed();
