<?php

declare(strict_types=1);

arch('policies')
    ->expect('App\Policies')
    ->toUse(Illuminate\Auth\Access\HandlesAuthorization::class)
    ->toHaveMethods([
        'viewAny',
        'view',
        'create',
        'update',
        'delete',
        'deleteAny',
    ]);
