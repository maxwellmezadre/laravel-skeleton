<?php

declare(strict_types=1);

arch('policies')
    ->expect('App\Policies')
    ->toHaveMethods([
        'viewAny',
        'view',
        'create',
        'update',
        'delete',
        'deleteAny',
    ]);
