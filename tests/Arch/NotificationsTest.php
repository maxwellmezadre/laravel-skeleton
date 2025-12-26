<?php

declare(strict_types=1);

use Illuminate\Notifications\Notification;

arch('notifications')
    ->expect('App\Notifications')
    ->toHaveConstructor()
    ->toExtend(Notification::class)
    ->toOnlyBeUsedIn([
        'App\Console\Commands',
        'App\Http\Controllers',
        'App\Observers',
    ]);
