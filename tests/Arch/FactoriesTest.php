<?php

declare(strict_types=1);

use Database\Factories\Concerns\RefreshOnCreate;
use Illuminate\Database\Eloquent\Factories\Factory;

arch('factories', function (string $factory): void {
    expect($factory)
        ->toUseTrait(RefreshOnCreate::class)
        ->toExtend(Factory::class)
        ->toHaveMethod('definition')
        ->toOnlyBeUsedIn([
            'App\Models',
        ]);

})->with('factories');
