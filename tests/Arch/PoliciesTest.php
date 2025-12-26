<?php

declare(strict_types=1);

use Illuminate\Auth\Access\HandlesAuthorization;

arch('policies')
    ->expect('App\Policies')
    ->toUse(HandlesAuthorization::class)
    ->toHaveMethods([
        'viewAny',
        'view',
        'create',
        'update',
        'delete',
        'deleteAny',
    ]);
