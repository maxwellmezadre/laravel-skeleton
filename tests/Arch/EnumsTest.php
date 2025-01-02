<?php

declare(strict_types=1);

arch('enums')
    ->expect('App\Enums')
    ->toBeEnums()
    ->toHaveMethod('getLabel')
    ->toExtendNothing();
